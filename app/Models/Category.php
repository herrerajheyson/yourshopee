<?php

namespace App\Models;

use App\Traits\CategoryTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Category extends Model
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;
    use CategoryTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Relación con las categorías asociadas.
     *
     * @return  \Illuminate\Support\Collection;
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
