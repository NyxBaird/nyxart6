<?php namespace App\Http\Controllers;
/**
 * Copyright © 2011 - 2017 NyxArt.org
 * All Rights Reserved. No part of this code may be reproduced without Elize Baird's express consent.
 * http://www.nyxart.org
 *
 * Created by Elize
 */

use Services\BlogService;

/**
 * Class BlogController
 * @package App\Http\Controllers
 */
class BlogController extends Controller
{
    protected $service;

    public function __construct(BlogService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $posts = $this->service->getSortedPosts();
        return view('blog', compact('posts'));
    }

    public function post($slug)
    {
        $posts = $this->service->getSortedPosts($slug);
        return view('blog', compact('posts'));
    }
}
