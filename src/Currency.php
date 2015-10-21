<?php

namespace Laravel\Shop;

use Flysap\Scaffold\ScaffoldAble;
use Flysap\Scaffold\Traits\ScaffoldTrait;
use Illuminate\Database\Eloquent\Model;
use Laravel\Relations\RelationTrait;

class Currency extends Model implements ScaffoldAble {

    use ScaffoldTrait, RelationTrait;

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