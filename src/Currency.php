<?php

namespace Laravel\Shop;

use Flysap\Scaffold\ScaffoldAble;
use Flysap\Scaffold\Traits\ScaffoldTrait;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model implements ScaffoldAble {

    use ScaffoldTrait;

    /**
     * @var string
     */
    protected $table = 'currencies';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    public $fillable = ['title', 'slug', 'symbol', 'active'];

}