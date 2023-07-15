<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getImageAttribute($image)
    {
        return asset('storage' . $image);
    }

    public function brand()
    {
        return $this->belongsTo(ProductBrand::class, 'brand_id');
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function getPriceAttribute()
    {
        return $this->formatCurrency($this->sell_price);
    }

    public function getFromPriceAttribute()
    {
        return $this->formatCurrency($this->sell_price + ($this->sell_price * 0.40));
    }

    public function formatCurrency($number) {
        return 'IDR ' . number_format($number, 0, ',', '.');
    }
}
