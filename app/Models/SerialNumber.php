<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SerialNumber extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'tbl_nomor_seri';

    public function getImageAttribute($image)
    {
        return asset('storage' . $image);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'product_id');
    }

    // public function getPriceAttribute()
    // {
    //     return $this->formatCurrency($this->price);
    // }

    // public function getFromPriceAttribute()
    // {
    //     return $this->formatCurrency($this->price + ($this->price * 0.40));
    // }

    public function formatCurrency($number) {
        return 'IDR ' . number_format($number, 0, ',', '.');
    }
}
