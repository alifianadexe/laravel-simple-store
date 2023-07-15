<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getRouteKey()
    {
        return $this->code;
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'transaction_products')->withPivot(['total', 'quantity']);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function getDateAttribute()
    {
        return date('Y-m-d', strtotime($this->created_at));
    }
}
