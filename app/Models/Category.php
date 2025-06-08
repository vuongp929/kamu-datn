<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
      use HasFactory;
    protected $table = 'categories';    
    protected $fillable = [
        'hinh_anh',
        'name',
        'trang_thai',
    ];

    protected $casts = [    
        'trang_thai'=>'boolean'
    ];
    
    public function sanPham(){
        return $this->hasMany(SanPham::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product', 'category_id', 'product_id');
    }
}
