<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductGallery;
use App\Models\ProductCategory;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'price',
        'description',
        'tags',
    ];

    public function galleries(){
        return $this->hasMany(ProductGallery::class, 'product_id', 'id');
    }

    public function category(){
        return $this->hasMany(ProductCategory::class, 'category_id', 'id');
    }
}
