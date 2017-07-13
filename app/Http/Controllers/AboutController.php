<?php namespace App\Http\Controllers;
/**
 * Copyright © 2011 - 2017 NyxArt.org
 * All Rights Reserved. No part of this code may be reproduced without Elize Baird's express consent.
 * http://www.nyxart.org
 *
 * Created by Elize
 */

/**
 * Class AboutController
 * @package App\Http\Controllers
 */
class AboutController extends Controller
{
    public function index()
    {
        return view('about');
    }
}
