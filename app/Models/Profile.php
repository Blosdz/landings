<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Profile
 * @package App\Models
 * @version December 17, 2021, 8:14 pm UTC
 *
 * @property string $dni
 * @property string $first_name
 * @property string $lastname
 * @property string $country_document
 * @property string $type_document
 * @property string $birthdate
 * @property string $nacionality
 * @property string $city
 */
class Profile extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'profiles';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'dni',
        'dni_r',
        'first_name',
        'lastname',
        'country_document',
        'type_document',
        'birthdate',
        'nacionality',
        'country',
        'city',
        'state',
        'address',
        'phone',
        'job',
        'verified',
        'obs',

        'dni2',
        'dni2_r',
        'first_name2',
        'lastname2',
        'country_document2',
        'type_document2',
        'birthdate2',
        'nacionality2',
        'country2',
        'city2',
        'state2',
        'address2',
        'phone2',
        'job2',
        'verified2',
        'obs2',

        'dni3',
        'dni3_r',
        'first_name3',
        'lastname3',
        'country_document3',
        'type_document3',
        'birthdate3',
        'nacionality3',
        'country3',
        'city3',
        'state3',
        'address3',
        'phone3',
        'job3',
        'verified3',
        'obs3',

        'user_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'dni' => 'string',
        'first_name' => 'string',
        'lastname' => 'string',
        'country_document' => 'string',
        'type_document' => 'string',
        'birthdate' => 'string',
        'nacionality' => 'string',
        'city' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
       
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    
}
