<?php

namespace Laravel\Shop\Traits;

use Laravel\Shop\Cart;
use Laravel\Shop\CartItem;
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
    public function cart() {
        return $this->hasOne(Cart::class, 'user_id', 'id');
    }

    /**
     * Add product to cart
     *
     * @param Product $product
     * @param array $attributes
     * @return mixed
     */
    public function toCart(Product $product, array $attributes = array()) {
        if(! $cart = $this->cart()->first()) {
            $cart = $this->cart()->save(
              new Cart
            );
        }

        $item = (new CartItem([
                'product_id' => $product->id
            ] + array_merge($attributes, $product->toArray())));

        $cart->items()
            ->save($item);

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
        if( $cart = $this->cart ) {
            $items = $cart->items()
                ->where('product_id', $product->id)
                ->get();

            $hasItems = $items->count();

            $items->each(function($item) {
                $item->delete();
            });

            if( $hasItems )
                event(new RemoveFromCart);
        }
    }
}
