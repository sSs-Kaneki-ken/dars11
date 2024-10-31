<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
    ];


    public function companies()
    {
        return $this->hasMany(Company::class);
    }


    public function products()
    {
        return $this->hasManyThrough(Product::class, Company::class, 'user_id', 'comp_id');
    }
}
