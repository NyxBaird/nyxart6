<?php namespace Domain\Spirit;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BlogPost
 * @package Domain
 *
 * @property $id
 * @property $name
 * @property $aliases
 * @property $parameters
 * @property $required_parameters
 * @property $description
 * @property $hook
 * @property $level
 * @property $impact_modifier
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 */
class Command extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'spirit_commands';

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
        'aliases',
        'parameters',
        'required_parameters',
        'description',
        'hook',
        'level',
        'impact_modifier'
    ];
}
