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
    /**
     * @var BlogService
     */
    protected $service;

    /**
     * BlogController constructor.
     * @param BlogService $service
     */
    public function __construct(BlogService $service)
    {
        $this->service = $service;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = $this->service->getSortedPosts();

        return view('blog', compact('posts'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function post($slug)
    {
        $posts = $this->service->getSortedPosts($slug);

        return view('blog', compact('posts'));
    }
}
