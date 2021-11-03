<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'desc',
        'price',
        'category_id',
        'user_id',
    ];

    protected $with = [
        'user'
    ];

    public function category(){
        return $this->belongsToMany(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function variations(){
        return $this->hasMany(Variation::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getMainImageAttribute()
    {
        return $this->images()->first();
    }

    public function getPriceAttribute()
    {
        return $this->variations()->orderBy('price')->first()->price ?? 0;
    }

    public function getStatusAttribute()
    {
        if($this->variations()->count() == 0)
            return 'empty';

        return $this->attributes['status'];
    }
}
