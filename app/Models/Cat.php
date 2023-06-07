<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'code', 'address'];
    public $timestamps = false;

    public function catService()
    {
        return $this->hasMany(Service::class);
    }
    
    public function menu()
    {
        return $this->hasMany(Menu::class);
    }
    
}