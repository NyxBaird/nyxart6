<?php namespace Services;
/**
 * Copyright © 2011 - 2017 NyxArt.org
 * All Rights Reserved. No part of this code may be reproduced without Elize Baird's express consent.
 * http://www.nyxart.org
 *
 * Created by Elize
 */

use Domain\Spirit\Command;
use Domain\Spirit\ResponseType;
use Libraries\SpiritConversationParser;

/**
 * Class SpiritService
 * @package Services
 */
class SpiritService extends Service
{
    /**
     * @var Command
     */
    protected $model;

    /**
     * @var SpiritConversationParser
     */
    protected $parser;

    /**
     * SpiritService constructor.
     * @param Command $model
     */
    public function __construct(Command $model)
    {
        $this->model = $model;
        $this->parser = new SpiritConversationParser();
    }

    /**
     * @param $cmd
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function grabCommand($cmd)
    {
        if (!$cmd)
            return false;

        return $this->model->where('name', $cmd)->orWhere('aliases', 'LIKE', "%$cmd%")->first();
    }

    /**
     * @param Command $command
     * @param $input
     * @return array
     */
    public function commandHandler(Command $command, $input)
    {
        $hook = explode('@', $command->hook);

        //This is our final array of params we'll send to the designated controller function
        $params = [];
        $requiredParams = explode('|', $command->required_parameters);
        $availableParams = explode(",", $command->parameters);

        //This checks our input string for parameters and returns them
        preg_match_all('/-[\s\S] (\S{3,})/', $input, $givenParams);

        //We only need this data from our preg_matched array
        $givenParams = $givenParams[0];

        foreach ($givenParams as $gp) {
            $gp = explode(" ", $gp);
            $identifier = substr($gp[0], 1);
            $entry = $gp[1];

            //Removes our given param from our required parans if relevant to keep track of required params
            if (in_array($identifier, $requiredParams)) {
                if (array_search($identifier, $requiredParams) !== false) {
                    unset($requiredParams[array_search($identifier, $requiredParams)]);
                }
            }

            $paramMatch = preg_grep("/$identifier\|(.*)/", $availableParams);
            $paramMatch = array_slice($paramMatch, 0, 1)[0];
            if (!$paramMatch) {
                continue;
            }

            $paramMatch = explode("|", $paramMatch);
            $params[$paramMatch[1]] = $entry;
        }

        if (!empty($requiredParams)) {
            $responseType = ResponseType::error();

            return [
                'type' => $this->parser->applyImpact($responseType),
                'response' => 'Required parameters are missing!'
            ];
        }

        //All hooks are in services, add the required namespacing here
        $hook[0] = 'Services\\' . $hook[0];
        $service = new $hook[0]($this);

        return $service->{$hook[1]}($params);
    }

    /**
     * Returns a bool telling if the command is for help
     *
     * @param $command
     * @return bool
     */
    public function checkForHelp($command)
    {
        $commandHelp = false;
        $pieces = explode(' ', $command);

        //If there are only two bits to the command and the second part is "?" or "help" we know it's a request for help with a command
        if (count($pieces) == 2 && ($pieces[1] == '?' || $pieces[1] == 'help')) {
            $commandHelp = true;
        }

        return substr(strtolower($command), 0, 4) == 'help' || substr($command, 0, 1) == '?' || $commandHelp;
    }

    /**
     * @param $command
     * @return array
     */
    public function parseHelp($command)
    {
        $response = '';
        $responseType = ResponseType::neutral();
        $pieces = explode(' ', $command);

        if (!isset($pieces[1]) || $pieces[1] == '') {
            //General help here
            if ($user = auth()->user()) {
                $commandList = Command::where('level', '<=', $user->level)->get();
            } else {
                $commandList = Command::where('level', 0)->get();
            }

            $response .= "Below is a list of all the commands you can access. Type \"(command) ?\" for more information on each command.<br />";

            foreach ($commandList as $cl) {
                $parameters = explode(',', $cl->parameters);

                $response .= '<br />';
                $response .= '<b style="color: green">' . $cl->name;

                foreach ($parameters as $p) {
                    $p = explode('|', $p);
                    $response .= ' -' . $p[0] . ' (' . $p[1] . ')';
                }

                $response .= '</b>';
            }

            $response .= '<br /><br />Parenthesis "()" denote where a parameter should go and should be left out of the final command. Here\'s an example of what one should enter to use the "register" command: "register -u NewUser -e email@address.com -p uncrackablePassword"<br />
                <br />
                Upcoming Spirit functionality: <br />
                -Spirit chat<br />
                -More complex command structures';

            return [
                'type' => $this->parser->applyImpact($responseType, auth()->user()),
                'response' => $response
            ];
        } else {
            $cmd = $this->grabCommand($pieces[0]);

            //If we have a valid command and permission to use it...
            if ($cmd && ((!auth()->user() && $cmd->level == 0) || (auth()->user() && $cmd->level <= auth()->user()->level))) {
                $parameters = explode(',', $cmd->parameters);
                $requiredParams = explode('|', $cmd->required_parameters);
                $aliases = $cmd->aliases ? explode('|', $cmd->aliases) : [];

                /**
                 * Build our response
                 */
                $response .= "You can use the \"{$pieces[0]}\" command like this;<br />
                                {$cmd->name} ";

                foreach ($parameters as $p) {
                    $param = explode('|', $p);

                    $response .= "-{$param[0]} ({$param[1]}) ";
                }

                $response .= "<br /><br />Required Parameters: -" . join(', -', $requiredParams);

                if (count($aliases)) {
                    $response .= "<br />Optional Aliases: " . join(', ', $aliases);
                }

                $response .= "<br />Description: " . $cmd->description;

                return [
                    'type' => $this->parser->applyImpact($responseType, auth()->user()),
                    'response' => $response
                ];

                //If someone's trying to access a command they don't have permission to access.
            } else if ($cmd) {
                $responseType = ResponseType::error();

                return [
                    'type' => $this->parser->applyImpact($responseType),
                    'response' => 'I was unable to find help on the given topic.'
                ];
            }
        }

        //Fails if we hit this point- ignore the impact from errors on help
        return [
            'type' => ResponseType::error(),
            'response' => 'I was unable to find help on the given topic.'
        ];
    }

    /**
     * This really only exists to bridge the gap between our controller and conversation parser
     *
     * @param $command
     */
    public function conversationHandler($command) {
        return [
            'type' => ResponseType::neutral(),
            'response' => '...'
        ];
    }
}