<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBrand extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getLogoAttribute($image)
    {
        return asset('storage' . $image);
    }
}
