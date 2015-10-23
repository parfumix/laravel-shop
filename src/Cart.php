<?php

namespace Laravel\Shop;

use Flysap\Scaffold\ScaffoldAble;
use Flysap\Scaffold\Traits\ScaffoldTrait;
use Illuminate\Database\Eloquent\Model;
use Laravel\Relations\RelationTrait;

class Cart extends Model implements ScaffoldAble {

    use ScaffoldTrait, RelationTrait;

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
    public $fillable = ['title', 'quantity'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items() {
        return $this->hasMany(CartItem::class);
    }

    /**
     * Return instance .
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shopable() {
        return $this->morphTo();
    }

    /**
     * @return array
     */
    public function skyFilter() {
        return [
            'created_at' => ['type' => 'date'],
            'updated_at' => ['type' => 'date'],
        ];
    }

    /**
     * @return array
     */
    public function skyShow() {
        return ['id', 'shopable_id', 'shopable_type'];
    }

    /**
     * Editable fields .
     *
     * @return array
     */
    public function skyEdit() {
        return [];
    }


    /**
     * Get total price with taxes
     *
     * @return float
     */
    public function totalPrice() {
        $price = 0.00;

        $items = $this->items;
        $items->each(function($item) use(& $price) {
            $price += $item->getTotalPrice();
        });

        return $price;
    }

    /**
     * Get total tax
     *
     * @return float
     */
    public function totalTax() {
        $tax = 0.00;

        $items = $this->items;
        $items->each(function($item) use(& $tax) {
            $tax += $item->getTotalTax();
        });

        return $tax;
    }
}