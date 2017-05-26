<?php namespace Services;
/**
 * Copyright © 2011 - 2017 NyxArt.org
 * All Rights Reserved. No part of this code may be reproduced without Elize Baird's express consent.
 * http://www.nyxart.org
 *
 * Created by Elize
 */

use Carbon\Carbon;
use Domain\BlogPost;
use Faker\Provider\cs_CZ\DateTime;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class BlogService
 * @package Services
 */
class BlogService extends Service
{
    /**
     * @var BlogPost
     */
    protected $model;

    /**
     * BlogService constructor.
     * @param BlogPost $model
     */
    public function __construct(BlogPost $model)
    {
        $this->model = $model;
        parent::__construct($this->model);
    }

    /**
     * @param bool $current
     * @return array
     */
    public function getSortedPosts($current = false)
    {
        $ordered = [];
        $posts = $this->all();

        $ordered['current'] = $current ? $this->getBySlug($current) : $posts->first();
        $ordered['sorted'] = $this->sortByDate($posts);

        return $ordered;
    }

    /**
     * @param Collection $posts
     * @return array
     */
    private function sortByDate(Collection $posts)
    {
        $sorted = [];

        foreach($posts as $k => $p){
            $year = date("Y", strtotime($p->published_on));
            $sorted[$year][] = $p;
        }

        return $sorted;
    }

    /**
     * @param $slug
     * @return mixed
     */
    private function getBySlug($slug)
    {
        return $this->model->newQuery()->where('slug', $slug)->first();
    }
}