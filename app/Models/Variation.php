<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=[
      'name', 'count' , 'price', 'product_id','discount'
    ];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
