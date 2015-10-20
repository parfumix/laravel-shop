<?php

namespace Laravel\Shop\Controllers\Admin;

use App\Http\Controllers\Controller;
use Eloquent\Sortable\Sortable;
use Illuminate\Http\Request;
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

        return view('shop::products.lists', compact('table'));
    }

    /**
     * Create new product .
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function create(Request $request) {
        if( $request->isMethod(Request::METHOD_POST) ) {
            $row = $this->repository->create(
                $request->all()
            );

            $row->save();

            return redirect(
                route('shop::edit-product', ['id' => $row->id])
            );
        }

        $form = FormBuilder\create_form(['method' => 'post', 'action' => '']);
        $form->addElements(
            $this->repository->skyEdit()
        );

        return view('shop::products.create', compact('form'));
    }

    /**
     * Edit product .
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id) {
        $row = $this->repository->find($id);

        $form = FormBuilder\create_form(['method' => 'post', 'action' => '']);
        $form->addElements(
            $row->skyEdit()
        );

        return view('shop::products.create', compact('form'));
    }

    /**
     * Delete product .
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id) {
        if( $product = $this->repository->find($id) ) {
            $product->delete();
        }

        return back();
    }
}