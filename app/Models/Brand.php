<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['name', 'country_of_origin'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}