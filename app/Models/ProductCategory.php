<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function children()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id', 'id');
    }

    public function getFullSlugAttribute()
    {
        $category = $this;
        $slugs = [];
        $stop = false;
        while(!$stop) {
            $slugs[] = $category->slug;
            if ($category->parent_id) {
                $category = $category->parent;
            } else {
                $stop = true;
            }
        }
        return collect($slugs)->reverse()->join('/');
    }

    public function parent()
    {
        return $this->belongsTo(ProductCategory::class, 'parent_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}