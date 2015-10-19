<?php

namespace Flysap\Media\Controllers\Admin;

use App\Http\Controllers\Controller;
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

    public function lists() {
        dd(1);
    }
}