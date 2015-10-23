<?php

namespace Laravel\Shop;

use App\User;
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
        'product'=> [
            'fields' => ['title' => ['translatable' => true]],
        ],
        'cart' => [
            'fields' => ['id' => []],
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
    public $fillable = ['cart_id', 'product_id', 'title', 'quantity'];

    /**
     * Return user instance .
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
     * @return array
     */
    public function skyFilter() {
        return [
            'cart_id' => ['label' => 'Cart', 'type' => 'select', 'options' => Cart::all()->lists('id', 'id')],
            'product_id' => ['label' => 'Users', 'type' => 'select', 'options' => Product::all()->lists('id', 'id')],
            'title' => ['type' => 'text'],
            'quantity' => ['type' => 'text'],
            'created_at' => ['type' => 'date'],
            'updated_at' => ['type' => 'date'],
        ];
    }

    /**
     * @return array
     */
    public function skyShow() {
        $eloquent = $this;

        return ['id', 'title', 'quantity', 'product_id' => ['label' => 'Product', 'closure' => function($value, $elements) use($eloquent) {
            $product = Product::where('id', $value)
                ->first();

            if( $product )
                return $product->present()->formatTitle();

            return $value;
        }], 'cart_id' => ['label' => 'Cart', 'closure' => function($value, $elements) use($eloquent) {
            $cart = Cart::where('id', $value)
                ->first();

            if( $cart )
                return $cart->id;

            return $value;
        }]];
    }

    /**
     * Editable fields .
     *
     * @return array
     */
    public function skyEdit() {
        return ['title' => ['type' => 'text'], 'quantity' => ['type' => 'number']];
    }
}