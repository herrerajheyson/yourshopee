<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_mobile',
        'status',
    ];

    /**
     * Relación con el detalle de la orden realizada
     *
     * @return  \Illuminate\Support\Collection;
     */
    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
