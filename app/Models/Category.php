<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "slug",
        "is_parent",
        "parent_id",
        "photo",
        "summary",
        "status",
    ];

    public function getParentCategoryAttribute()
    {
        return $this->find($this->parent_id);
    }

    public function products()
    {
        return $this->hasMany(Product::class,'cat_id','id');
    }
}
