<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_payment','user_id','total_count',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
