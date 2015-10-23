<?php

namespace Laravel\Shop;

use Flysap\Scaffold\ScaffoldAble;
use Flysap\Scaffold\Traits\ScaffoldTrait;
use Illuminate\Database\Eloquent\Model;
use Laravel\Relations\RelationTrait;
use Parfumix\FormBuilder as Form;

class Order extends Model implements ScaffoldAble {

    use ScaffoldTrait, RelationTrait;

    /**
     * @var string
     */
    protected $table = 'orders';

    /**
     * @var bool
     */
    public $timestamps = false;


}