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
use Laravel\Shop\Presenters\ProductPresenter;
use Parfumix\FormBuilder as Form;

class Product extends Model implements ImageAble, Translatable, MetaAble, MetaSeoable, Sortable, ScaffoldAble {

    use ImageAbleTrait, TranslatableTrait, MetaTrait, MetaSeoTrait, SortableTrait, ScaffoldTrait, RelationTrait;

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
     * @var array
     */
    public $relation = ['currency' => [
        'fields' => ['title' => []]
    ]];

    /**
     * @var array
     */
    protected $translatedAttributes = [
        'title',
        'description'
    ];

    protected $translationClass = ProductTranslation::class;

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
        }], 'currency_id' => ['label' => 'Currency', 'closure' => function($value, $elements) {
            $currency = Currency::where('id', $value)
                ->first();

            if( $currency )
                return $currency->title;

            return $value;
        }], 'active'];
    }

    /**
     * @return array
     */
    public function skyFilter() {
        return [
            'currency_id' => ['label' => 'Currency', 'type' => 'select', 'options' => Currency::all()->lists('slug', 'id')],
            'price' => ['type' => 'text'],
            'active' => ['type' => 'checkbox'],
        ];
    }

    /**
     * Return lists of widgets for current page .
     *
     * @return array
     */
    public function widgets() {
        return ['orders'];
    }

    /**
     * @return ProductPresenter
     */
    public function present() {
        return new ProductPresenter($this);
    }

    /**
     * Get currency instance .
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency() {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

}