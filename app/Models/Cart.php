<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'cart';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'product_name',
        'product_price',
        'product_image'
    ];

}
