<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    protected $table = 'tbl_transaction';


    public function detail()
    {
        return $this->belongsTo(TransactionDetail::class, 'transaction_id');
    }
}
