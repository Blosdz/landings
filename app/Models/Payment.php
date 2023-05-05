<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\User;
use App\Models\Contract;
use App\Models\ClientPayment;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Payment
 * @package App\Models
 * @version December 17, 2021, 9:25 pm UTC
 *
 * @property string $status
 */
class Payment extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'payments';
    

    protected $dates = ['deleted_at', 'date_transaction'];



    public $fillable = [
        'month',
        'total',
        'status',
        'date_transaction',
        'user_id',
        'prepay_code',
        'expire_time',
        'transact_code',
        'transact_timestamp'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'string'
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

    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class, 'id', 'payment_id');
    }

    public function client_payment(): BelongsTo
    {
        return $this->belongsTo(ClientPayment::class,'id','payment_id');
    }
}
