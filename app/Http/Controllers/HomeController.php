<?php namespace App\Http\Controllers;
/**
 * Copyright © 2011 - 2017 NyxArt.org
 * All Rights Reserved. No part of this code may be reproduced without Elize Baird's express consent.
 * http://www.nyxart.org
 *
 * Created by Elize
 */

use Services\HomeService;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * @var HomeService
     */
    protected $service;

    /**
     * HomeController constructor.
     * @param HomeService $service
     */
    public function __construct(HomeService $service)
    {
            $this->service = $service;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = $this->service->viewData();
        return view('home', compact('data'));
    }
}
