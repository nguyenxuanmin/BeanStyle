<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function productSizes()
    {
        return $this->hasMany(ProductSize::class);
    }

    public function productColors()
    {
        return $this->hasMany(ProductColor::class);
    }
}
