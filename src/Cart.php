<?php

namespace Laravel\Shop;

use App\User;
use Flysap\Scaffold\ScaffoldAble;
use Flysap\Scaffold\Traits\ScaffoldTrait;
use Illuminate\Database\Eloquent\Model;
use Laravel\Relations\RelationTrait;

class Cart extends Model implements ScaffoldAble {

    use ScaffoldTrait, RelationTrait;

    /**
     * @var array
     */
    public $relation = [
        'product'=> [
            'fields' => ['title' => ['translatable' => true]],
        ],
        'user' => [
            'fields' => ['email' => []],
        ]
    ];

    /**
     * @var string
     */
    protected $table = 'carts';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var array
     */
    public $fillable = ['product_id', 'title', 'quantity'];

    /**
     * Return user instance .
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Return product instance .
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    /**
     * @return array
     */
    public function skyFilter() {
        return [
            'user_id' => ['label' => 'Users', 'type' => 'select', 'options' => User::all()->lists('email', 'id')],
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
        }], 'user_id' => ['label' => 'User', 'closure' => function($value, $elements) use($eloquent) {
            $user = User::where('id', $value)
                ->first();

            if( $user )
                return $user->email;

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