<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'tbl_barang';

    public function formatCurrency($number) {
        return 'IDR ' . number_format($number, 0, ',', '.');
    }

    public function getFromPriceAttribute()
    {
        return $this->formatCurrency($this->price + ($this->price * 0.40));
    }

}
