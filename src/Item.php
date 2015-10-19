<?php

namespace Laravel\Shop;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {

    /**
     * @var string
     */
    protected $table = 'cart_items';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var array
     */
    public $fillable = ['cart_id', 'title', 'quantity'];


}