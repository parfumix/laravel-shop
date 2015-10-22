<?php

namespace Laravel\Shop\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class RemoveFromCart extends Event {

    use SerializesModels;

    /**
     * @var
     */
    public $cart;

    public function __construct() {
        //
    }

}
