<?php

namespace Laravel\Shop\Traits;

use App\User;
use Laravel\Shop\Cart;
use Laravel\Shop\CartItem;
use Laravel\Shop\Events\AddedToCart;
use Laravel\Shop\Events\RemoveFromCart;
use Laravel\Shop\Exceptions\CartException;
use Laravel\Shop\Product;

trait ShopTrait {

    /**
     * Authentificate user .
     * @return mixed
     * @throws CartException
     */
    public function authentificate() {
        if( $this instanceof User )
            return \Auth::user();

        throw new CartException('Implement authentificate function.');
    }

    /**
     * Get cart items .
     *
     * @return mixed
     */
    public function cart() {
        return $this->morphOne(
            Cart::class, 'shopable'
        );
    }

    /**
     * Add product to cart
     *
     * @param Product $product
     * @param array $attributes
     * @return mixed
     */
    public function toCart(Product $product, array $attributes = array()) {
        if (! $cart = $this->cart()->first()) {
            $cart = $this->cart()->save(
                new Cart
            );
        }

        $item = (new CartItem([
                'product_id' => $product->id
            ] + array_merge($attributes, $product->toArray())
        ));

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
        if ($cart = $this->cart) {
            $items = $cart->items()
                ->where('product_id', $product->id)
                ->get();

            $hasItems = $items->count();

            $items->each(function ($item) {
                $item->delete();
            });

            if ($hasItems)
                event(new RemoveFromCart);
        }
    }
}
