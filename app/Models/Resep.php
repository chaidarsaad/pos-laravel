<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    protected $table = 'resep';
    protected $fillable = [
        'stokbahan_id',
        'netto',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function stokbahan()
    {
        return $this->belongsTo(Stokbahan::class,'stokbahan_id','id');
    }
}
