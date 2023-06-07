<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'cat_id'];
    public $timestamps = false;

    // const SORT = [
    //     'default' => 'No sort',
    //     'price_0-50' => 'By price less 50$',
    //     'price_51-100' => 'By price 51-100$',
    //     'price_101-500' => 'By price 101-500$',
    //     'price_501-...' => 'By price more 501$',
    // ];

    // const FILTER = [
    //     'default' => 'Show all',
    //     'cat' => 'Filter by Car Service',
    // ];

    public function cat()
    {
        return $this->belongsTo(Cat::class);
    }

    public function dish()
    {
        return $this->hasMany(Dish::class);
    }
}