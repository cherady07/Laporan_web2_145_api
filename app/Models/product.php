<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'warranty_years', 'brand_id'];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
