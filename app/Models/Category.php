<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categories';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'sort_order',
        'active'
    ];

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
