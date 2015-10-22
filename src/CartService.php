<?php

namespace Laravel\Shop;

class CartService {

    /**
     * @var
     */
    protected $repository;

    public function __construct(Cart $repository) {
        $this->repository = $repository;
    }

}