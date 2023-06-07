<?php

namespace App\Entities;

use App\Models\Dish;

class Cart
{

    private $dishes;

    public function __construct(array $cart) 
    {
        $hotelsId = array_keys($cart);
        $this->dishes = Dish::whereIn('id', $hotelsId)->get();
        $this->dishes = $this->dishes->map(function($p) use ($cart) {
            $p->count = $cart[$p->id];
            return $p;
        });
    }


    public function total()
    {
        return $this->dishes->reduce(function ($carry, $item) {
            return $carry + $item->count * $item->price;
        }, 0);
    }

    public function dishes()
    {
        return $this->dishes;
    }

}