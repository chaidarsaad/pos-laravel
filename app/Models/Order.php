<?php

namespace App\Models;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table= 'orders';
    protected $fillable = [
        'user_id',
        'fname',
        'phone',
        'districts_id',
        'address1',
        'total_price',
        // 'payment_mode',
        // 'payment_id',
        'message',
        'status',
        'status_pesanan',
        'tracking_no',
        'status_pickup'
    ];

    public function orderitems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function district(){
        return $this->belongsTo( District::class, 'districts_id', 'id');
    }
}
