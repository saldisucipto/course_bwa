<?php

namespace App\Models;

use App\Models\ProductCategory;
use App\Models\ProductGallery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // deklare table
    protected $table = 'product';

    protected $fillable = [
        'name',
        'price',
        'description',
        'tags',
    ];

    public function galleries()
    {
        return $this->hasMany(ProductGallery::class, 'id', 'product_id');
    }

    public function category()
    {
        return $this->hasMany(ProductCategory::class, 'id', 'category_id');
    }
}
