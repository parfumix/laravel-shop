<?php

namespace Laravel\Shop;

use Flysap\Scaffold\ScaffoldAble;
use Flysap\Scaffold\Traits\ScaffoldTrait;
use Illuminate\Database\Eloquent\Model;
use Laravel\Relations\RelationTrait;

class Item extends Model implements ScaffoldAble {

    use ScaffoldTrait, RelationTrait;

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