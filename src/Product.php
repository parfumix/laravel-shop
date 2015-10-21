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
use Flysap\Scaffold\ScaffoldAble;
use Flysap\Scaffold\Traits\ScaffoldTrait;
use Illuminate\Database\Eloquent\Model;
use Laravel\Meta\Eloquent\MetaSeoable;
use Laravel\Meta\Eloquent\MetaSeoTrait;
use Laravel\Relations\RelationTrait;
use Parfumix\FormBuilder as Form;

class Product extends Model implements ImageAble, Translatable, MetaAble, MetaSeoable, Sortable, ScaffoldAble {

    use ImageAbleTrait, TranslatableTrait, MetaTrait, MetaSeoTrait, SortableTrait, ScaffoldTrait, RelationTrait;

    /**
     * @var array
     */
    protected $translatedAttributes = [
        'title',
        'description'
    ];

    protected $translationClass = ProductTranslation::class;

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
    public $fillable = ['price', 'active'];

    /**
     * @return array
     */
    public function skyShow() {
        $eloquent = $this;

        return ['id', 'title', 'description', 'image' => ['closure' => function($value, $elements) use($eloquent) {
            $id = $elements['elements']['id'];

            $image = $eloquent->where('id', $id)->first()->images()->orderBy('id', 'desc')->first();

            if( $image )
                return $image->present()->render(['width' => '200px']);

            return $value;
        }]];
    }

    /**
     * Return lists of widgets for current page .
     *
     * @return array
     */
    public function widgets() {
        return [''];
    }


}