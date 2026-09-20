<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['user_id', 'name', 'hpp', 'price', 'stock', 'min_stock', 'unit'];

    public function sales() {
        return $this->hasMany(Sale::class);
    }
}