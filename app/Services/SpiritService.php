<?php namespace Services;
/**
 * Copyright © 2011 - 2017 NyxArt.org
 * All Rights Reserved. No part of this code may be reproduced without Elize Baird's express consent.
 * http://www.nyxart.org
 *
 * Created by Elize
 */

use App\Domain\User;
use Carbon\Carbon;
use Domain\BlogPost;
use Domain\Spirit\Command;
use Domain\Spirit\ResponseType;
use Faker\Provider\cs_CZ\DateTime;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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
     * SpiritService constructor.
     * @param Command $model
     */
    public function __construct(Command $model)
    {
        $this->model = $model;
    }

    public function parseHelp($command)
    {
        $response = '';
        $responseType = ResponseType::where('name', 'neutral')->first();
        $pieces = explode(' ', $command);

        if (!isset($pieces[1]) || $pieces[1] == '') {
            //General help here
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

                return ['type' => $this->applyImpact($responseType, auth()->user()), 'response' => $response];

            //If someone's trying to access a command they don't have permission to access.
            } else if ($cmd) {
                $responseType = ResponseType::where('name', 'error')->first();

                return ['type' => $this->applyImpact($responseType), 'response' => 'I was unable to find help on the given topic.'];
            }
        }

        //Fails if we hit this point- ignore the impact from errors on help
        return ['type' => ResponseType::where('name', 'error')->first(), 'response' => 'I was unable to find help on the given topic.'];
    }

    public function commandHandler(Command $command, $input)
    {
        $pieces = explode(' ', $input);
        $possibleParams = explode(',', $command);

        foreach ($pieces as $p) {
            //Wip add command functionality
        }
    }

    public function applyImpact(ResponseType $type, $user, $modifier = 0)
    {
        if (!$user && $type->base_impact + $modifier <= 10) {
            return $type;
        } else if (!$user) {
            //WIP: Apply negative impact to session
        }
        //wip work out impact for user
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

    public function grabCommand($cmd)
    {
        return $this->model->where('name', $cmd)->orWhere('aliases', 'LIKE', "%$cmd%")->first();
    }
}