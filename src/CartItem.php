<?php

namespace Laravel\Shop;

use Flysap\Scaffold\ScaffoldAble;
use Flysap\Scaffold\Traits\ScaffoldTrait;
use Illuminate\Database\Eloquent\Model;
use Laravel\Relations\RelationTrait;

class CartItem extends Model implements ScaffoldAble {

    use ScaffoldTrait, RelationTrait;

    /**
     * @var array
     */
    public $relation = [
        'currency' => [
            'fields' => ['title' => []]
        ]
    ];

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
    public $fillable = ['cart_id', 'tax', 'product_id', 'quantity', 'attributes'];

    /**
     * Return instance .
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cart() {
        return $this->belongsTo(Cart::class);
    }

    /**
     * Return product instance .
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product() {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get currency instance .
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency() {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

    /**
     * @return array
     */
    public function skyFilter() {
        return [
            'currency_id' => ['label' => 'Currency', 'type' => 'select', 'options' => Currency::all()->lists('slug', 'id')],
            'quantity' => ['type' => 'text'],
            'created_at' => ['type' => 'date'],
            'updated_at' => ['type' => 'date'],
        ];
    }

    /**
     * @return array
     */
    public function skyShow() {
        return ['id', 'quantity', 'tax', 'attributes'];
    }

    /**
     * Editable fields .
     *
     * @return array
     */
    public function skyEdit() {
        return ['quantity' => ['type' => 'number'], 'tax' => ['type' => 'text'], 'attributes' => ['type' => 'textarea']];
    }


    /**
     * Get single price .
     *
     * @param bool $includeTax
     * @return int|mixed
     */
    public function getSinglePrice($includeTax = true) {
        return $this->price + $includeTax ? $this->getSingleTax() : 0;
    }

    /**
     * Get total price with taxes .
     *
     * @param bool $includeTax
     * @return int|mixed
     */
    public function getTotalPrice($includeTax = true) {
        return $this->getSinglePrice($includeTax) * $this->quantity;
    }

    /**
     * Get total taxes .
     *
     * @return mixed
     */
    public function getTotalTax() {
        return $this->getSingleTax() * $this->quantity;
    }

    /**
     * Get single tax .
     *
     * @return mixed
     */
    public function getSingleTax() {
        return $this->tax;
    }

}