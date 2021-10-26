<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public const IS_SUPER_ADMIN = 1;
    public const IS_ADMIN = 2;
    public const IS_SHOP_OWNER = 3;
    public const IS_WRITER = 4;
    public const IS_USER = 5;

    protected $fillable = ['name'];


}
