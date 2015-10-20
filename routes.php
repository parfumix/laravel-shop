<?php

Route::group(['prefix' => 'admin/shop', 'as' => 'shop::', 'middleware' => 'role:admin', 'namespace' => 'Laravel\Shop\Controllers\Admin'], function() {

    /**
     * Define products controller .
     *
     */
    Route::get('products', ['as' => 'shop-products', 'uses' => 'ProductController@lists']);
    Route::match(['get', 'post'],'products/create', ['as' => 'create-product', 'uses' => 'ProductController@create']);
    Route::get('products/edit/{id}', ['as' => 'edit-product', 'uses' => 'ProductController@edit']);
    Route::get('products/delete/{id}', ['as' => 'delete-product', 'uses' => 'ProductController@delete']);

    /**
     * Define routes for cart controller .
     *
     */
    Route::get('carts', ['as' => 'shop-carts', 'uses' => 'CartController@lists']);
    Route::match(['get', 'post'],'cart/create', ['as' => 'create-cart', 'uses' => 'CartController@create']);
    Route::get('cart/edit/{id}', ['as' => 'edit-cart', 'uses' => 'CartController@edit']);
    Route::get('cart/delete/{id}', ['as' => 'delete-cart', 'uses' => 'CartController@delete']);

    /**
     * Define routes for currency controller .
     *
     */
    Route::get('currencies', ['as' => 'shop-currencies', 'uses' => 'CurrenciesController@lists']);
    Route::match(['get', 'post'],'currency/create', ['as' => 'create-currency', 'uses' => 'CurrenciesController@create']);
    Route::get('currency/edit/{id}', ['as' => 'edit-currency', 'uses' => 'CurrenciesController@edit']);
    Route::get('currency/delete/{id}', ['as' => 'delete-currency', 'uses' => 'CurrenciesController@delete']);
});