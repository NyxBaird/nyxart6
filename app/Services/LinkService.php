<?php namespace Services;
/**
 * Copyright © 2011 - 2017 NyxArt.org
 * All Rights Reserved. No part of this code may be reproduced without Elize Baird's express consent.
 * http://www.nyxart.org
 *
 * Created by Elize
 */

use App\Domain\Link;

/**
 * Class LinkService
 * @package Services
 */
class LinkService extends Service
{
    /**
     * @var Link
     */
    protected $model;

    /**
     * BlogService constructor.
     * @param Link $model
     */
    public function __construct(Link $model)
    {
        $this->model = $model;
        parent::__construct($this->model);
    }
}