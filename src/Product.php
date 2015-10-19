<?php

namespace Laravel\Shop;

use Eloquent\ImageAble\ImageAble;
use Eloquent\ImageAble\ImageAbleTrait;
use Eloquent\Meta\MetaAble;
use Eloquent\Meta\MetaTrait;
use Eloquent\Sortable\Sortable;
use Eloquent\Sortable\SortableTrait;
use Eloquent\Translatable\Translatable;
use Eloquent\Translatable\TranslatableTrait;
use Illuminate\Database\Eloquent\Model;
use Laravel\Meta\Eloquent\MetaSeoable;
use Laravel\Meta\Eloquent\MetaSeoTrait;

class Product extends Model implements ImageAble, Translatable, MetaAble, MetaSeoable, Sortable {

    use ImageAbleTrait, TranslatableTrait, MetaTrait, MetaSeoTrait, SortableTrait;

    /**
     * @var array
     */
    protected $translatedAttributes = [
        'title',
        'description'
    ];

    /**
     * @var string
     */
    protected $table = 'products';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    public $fillable = ['active'];


}