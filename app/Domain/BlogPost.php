<?php namespace Domain;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BlogPost
 * @package Domain
 *
 * @property $id
 * @property $title
 * @property $body
 * @property $published_on
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 */
class BlogPost extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'blog_posts';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
        'published_on',
    ];
}
