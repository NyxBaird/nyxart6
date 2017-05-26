<?php namespace App\Domain;
/**
 * Copyright © 2011 - 2017 NyxArt.org
 * All Rights Reserved. No part of this code may be reproduced without Elize Baird's express consent.
 * http://www.nyxart.org
 *
 * Created by Elize
 */

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Link
 * @package Domain
 *
 * @property $id
 * @property $url
 * @property $title
 * @property $type
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 */
class Link extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'links';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url',
        'title',
        'type',
    ];

    /**
     * Scope a query to only include "main" links
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMain($query)
    {
        return $query->where('type', 'main');
    }
}
