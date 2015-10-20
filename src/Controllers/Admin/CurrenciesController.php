<?php

namespace Laravel\Shop\Controllers\Admin;

use App\Http\Controllers\Controller;
use Laravel\Shop\Currency;
use Parfumix\TableManager;
use Parfumix\FormBuilder;
use Localization as Locale;
use FLysap\Support;

class CurrenciesController extends Controller {

    protected $repository;

    public function __construct() {
        $this->repository = (new Currency);
    }
}