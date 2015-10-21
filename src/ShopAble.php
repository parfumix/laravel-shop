<?php

namespace Laravel\Shop;

interface ShopAble {

    /**
     * Add product to cart
     *
     * @param $product_id
     * @param array $attributes
     * @return mixed
     */
    public function addProduct($product_id, array $attributes = array());

    /**
     * Drop product from cart .
     *
     * @param $product_id
     * @param array $attributes
     * @return mixed
     */
    public function dropProduct($product_id, array $attributes = array());
}