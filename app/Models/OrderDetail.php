<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'sku',
        'amount',
        'price',
        'discount',
        'order_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'sku',
    ];

    /**
     * Relación con la orden realizada.
     *
     * @return  \Illuminate\Support\Collection;
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
