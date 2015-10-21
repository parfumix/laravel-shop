<?php

namespace Laravel\Shop\Traits;

use Laravel\Shop\Cart;

trait ShopTrait {

    /**
     * On boot add new relation .
     */
    public function boot() {
        if( isset($this->relation) )
            $relation = $this->relation;

        $this->relation = array_merge($relation, [
            'carts'
        ]);
    }

    /**
     * Get cart items .
     *
     * @return mixed
     */
    public function carts() {
        return $this->hasMany(Cart::class, 'user_id', 'id');
    }


    /**
     * Add product to cart
     *
     * @param $product_id
     * @param array $attributes
     * @return mixed
     */
    public function addItem($product_id, array $attributes = array()) {
        return $this->carts()->save((new Cart([
            'product_id' => $product_id
        ] + $attributes)));
    }

    /**
     * Drop product from cart .
     *
     * @param $product_id
     * @return mixed
     */
    public function dropItem($product_id) {
        $product = $this->carts()->where('product_id', $product_id)
            ->first();

        return $product->delete();
    }
}
