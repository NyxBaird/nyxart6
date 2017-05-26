<?php namespace Domain;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Music
 * @package Domain
 *
 * @property $id
 * @property $slug
 * @property $title
 * @property $cover
 * @property $youtube
 * @property $release_date
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 */
class Music extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'music';

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
        'slug',
        'title',
        'cover',
        'youtube',
        'release_date',
    ];
}
