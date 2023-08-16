<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stokbahan extends Model
{
    use HasFactory;
    protected $table = 'stokbahan';
    protected $fillable = [
        'name',
        'netto'
    ];
}
