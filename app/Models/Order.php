<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = [
        'customer_full_name',
        'is_ended'
    ];

    public function products(){
        return $this->belongsToMany(Product::class, 'product_order');
    }

    public function getCustomerFullnameAttribute(){
        return ucfirst(strtolower($this->getAttribute('customer_firstname'))).' '.strtoupper($this->getAttribute('customer_lastname'));
    }

    public function getIsEndedAttribute(){
        return $this->getAttribute('date') < Carbon::now()->toDateString();
    }
}
