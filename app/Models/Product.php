<?php

namespace App\Models;

use App\Traits\ProductTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;
    use ProductTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'sku',
        'name',
        'brand',
        'price',
        'amount',
        'discount',
        'reference',
        'image',
        'description',
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
     * Relación con las categorías asociadas.
     *
     * @return  \Illuminate\Support\Collection;
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
