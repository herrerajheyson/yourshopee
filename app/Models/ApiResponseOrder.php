<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiResponseOrder extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'order_id',
        'request_id',
        'process_url',
        'status'
    ];

    /**
     * Relación con la orden asociada.
     *
     * @return  \Illuminate\Support\Collection;
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
