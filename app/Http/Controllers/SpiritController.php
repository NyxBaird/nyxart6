<?php namespace App\Http\Controllers;
/**
 * Copyright © 2011 - 2017 NyxArt.org
 * All Rights Reserved. No part of this code may be reproduced without Elize Baird's express consent.
 * http://www.nyxart.org
 *
 * Created by Elize
 */

use Illuminate\Http\Request;
use Services\SpiritService;

/**
 * Class SpiritController
 * @package App\Http\Controllers
 */
class SpiritController extends Controller
{
    /**
     * @var SpiritService
     */
    protected $service;

    /**
     * SpiritController constructor.
     * @param SpiritService $service
     */
    public function __construct(SpiritService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function commandHandle(Request $request)
    {
        $command = $request->input('command');

        //If this is a request for help...
        if ($this->service->checkForHelp($command)) {
            return response()->json($this->service->parseHelp($command));
        }

        //If this is a valid command...
        if ($issued = $this->service->grabCommand(explode(' ', $command)[0])) {
            return response()->json($this->service->commandHandler($issued, $command));
        }
    }
}
