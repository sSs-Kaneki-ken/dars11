<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'comp_id',
        'image',
        'price'
    ];


    public function company()
    {
        return $this->belongsTo(Company::class, 'comp_id');
    }
}
