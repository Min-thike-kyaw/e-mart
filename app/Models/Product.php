<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'summary',
        'stock',
        'brand_id',
        'cat_id',
        'child_cat_id',
        'photo',
        'price',
        'offer_price',
        'discount',
        'size',
        'condition',
        'vendor_id',
        'status'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);

    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id', 'id');
    }

    public function childCategory()
    {
        return $this->belongsTo(Category::class, 'child_cat_id', 'id');
    }
}
