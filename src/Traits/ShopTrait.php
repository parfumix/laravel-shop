<?php

namespace Laravel\Shop\Traits;

use Laravel\Shop\Cart;
use Laravel\Shop\Events\AddedToCart;
use Laravel\Shop\Events\RemoveFromCart;
use Laravel\Shop\Product;

trait ShopTrait {

    #@todo
    public static function boot()
    {
        parent::boot();

        /*if( isset($this->relation) )
                $relation = $this->relation;

            $this->relation = array_merge($relation, [
                'carts'
            ]);
            $post->created_by = Auth::user()->id;
            $post->updated_by = Auth::user()->id;
        */
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
     * @param Product $product
     * @param array $attributes
     * @return mixed
     */
    public function inCart(Product $product, array $attributes = array()) {
        $cart = (new Cart([
                'product_id' => $product->id
            ] + $attributes));

        $this->carts()
            ->save($cart);

        event(new AddedToCart($cart));

        return $cart;
    }

    /**
     * Drop product from cart .
     *
     * @param Product $product
     * @return mixed
     */
    public function outCart(Product $product) {
        $carts = $this->carts()
            ->where('product_id', $product->id)
            ->get();

        $carts->each(function($cart) {
            $cart->delete();
        });

        event(new RemoveFromCart);
    }
}
