<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory;
    //,SoftDeletes;
    protected $guarded = ['id'];


    public function invoice_items()
    {
        return $this->hasMany(Invoice_item::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'created_by')->select(['id', 'name']);
    }
}
