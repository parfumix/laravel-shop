<?php

namespace Laravel\Shop;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model {

    /**
     * @var string
     */
    protected $table = 'product_translations';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    public $fillable = ['title', 'description'];


}