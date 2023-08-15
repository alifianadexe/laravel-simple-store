<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    protected $table = 'tbl_detail_transaction';

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'product_id');
    }

    public function serialnumber(){
        return $this->belongsTo(SerialNumber::class, 'serial_no_id');
    }
}
