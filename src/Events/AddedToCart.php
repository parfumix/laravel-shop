<?php

namespace Laravel\Shop\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Laravel\Shop\Cart;

class AddedToCart extends Event {

    use SerializesModels;

    /**
     * @var
     */
    public $cart;

    public function __construct(Cart $cart) {
        $this->cart = $cart;
    }

}
