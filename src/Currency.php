<?php

namespace Laravel\Shop;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model {

    /**
     * @var string
     */
    protected $table = 'currencies';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var array
     */
    public $fillable = ['title', 'slug', 'symbol', 'active'];

}