<?php

namespace Laravel\Shop;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model {

    /**
     * @var string
     */
    protected $table = 'carts';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var array
     */
    public $fillable = ['user_id', 'session_id'];


}