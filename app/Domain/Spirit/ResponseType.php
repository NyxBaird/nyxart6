<?php namespace Domain\Spirit;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BlogPost
 * @package Domain
 *
 * @property $id
 * @property $name
 * @property $base_impact
 * @property $color
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 */
class ResponseType extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'spirit_response_types';

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
        'name',
        'base_impact',
        'color'
    ];
}
