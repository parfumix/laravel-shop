<?php

namespace Laravel\Shop;

interface ShopAble {


    /**
     * Add product to cart
     *
     * @param Product $product
     * @param array $attributes
     * @return mixed
     * @internal param $product_id
     */
    public function toCart(Product $product, array $attributes = array());

    /**
     * Drop product from cart .
     *
     * @param Product $product
     * @return mixed
     */
    public function outCart(Product $product);
}