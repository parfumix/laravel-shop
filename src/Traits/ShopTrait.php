<?php

namespace Laravel\Shop\Traits;

use Laravel\Shop\Cart;

trait ShopTrait {

    /**
     * Get cart items .
     *
     * @return mixed
     */
    public function products() {
        return $this->hasMany(Cart::class, 'id', 'user_id');
    }
}
