<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Extension\Table\Table;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'productid',
        'name',
        'price',
        'description',
        'image',
        'coupon',
    ];
}
