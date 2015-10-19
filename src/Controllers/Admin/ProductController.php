<?php

namespace Laravel\Shop\Controllers\Admin;

use App\Http\Controllers\Controller;
use Eloquent\Sortable\Sortable;
use Laravel\Shop\Product;
use Parfumix\TableManager;
use Parfumix\FormBuilder;
use Localization as Locale;
use FLysap\Support;

class ProductController extends Controller {

    protected $repository;

    public function __construct() {
        $this->repository = (new Product());
    }

    /**
     * Lists products .
     *
     * @return \Illuminate\View\View
     */
    public function lists() {
        $table = TableManager\table(
            $this->repository, 'eloquent', [
                'class' => 'table table-hover',
                'sortable' => ($this->repository instanceof Sortable)
            ]
        );

        return view('shop::products', compact('table'));
    }
}