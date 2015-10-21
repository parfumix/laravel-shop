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

    /**
     * Add product to cart
     *
     * @param $product_id
     * @param array $attributes
     * @return mixed
     */
    public function addProduct($product_id, array $attributes = array()) {

    }

    /**
     * Drop product from cart .
     *
     * @param $product_id
     * @param array $attributes
     * @return mixed
     */
    public function dropProduct($product_id, array $attributes = array()) {

    }
}
