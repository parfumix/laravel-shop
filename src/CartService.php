<?php

namespace Laravel\Shop;

use Laravel\Shop\Exceptions\CartException;

class CartService {

    /**
     * @var Cart
     */
    protected $repository;

    public function __construct(Cart $cart) {
        $this->repository = $cart;
    }

    /**
     * Get current user cart .
     *
     */
    public function my() {
        $class = config('laravel-shop.shopable_class');

        if(! class_exists($class))
            throw new CartException('Invalid shopAble class');

        $entity = (new $class)->authentificate();

        if( ! $entity )
            throw new CartException('Failed authentification');

        if( ! $entity instanceof ShopAble )
            throw new CartException('Implement ShopAble contract');

        return $entity->cart;
    }

    /**
     * Find by type .
     *
     * @param $type
     * @param $id
     */
    public function findByType($type, $id) {
        return $this->repository
            ->where('shopable_id', $id)
            ->where('shopable_type', $type)
            ->get();
    }
}