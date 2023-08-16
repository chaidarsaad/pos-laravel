<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pos extends Model
{
    protected $table = 'pos';
    protected $fillable = [
        'prod_id',
        'prod_qty',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,'prod_id','id');
    }
}
