<?php

Route::group(['prefix' => 'admin/shop', 'as' => 'shop::', 'middleware' => 'role:admin', 'namespace' => 'Laravel\Shop\Controllers\Admin'], function() {

    Route::get('products', ['as' => 'shop-products', 'uses' => 'ProductController@lists']);
    Route::match(['get', 'post'],'products/create', ['as' => 'create-product', 'uses' => 'ProductController@create']);
    Route::get('products/edit/{id}', ['as' => 'edit-product', 'uses' => 'ProductController@edit']);
    Route::get('products/delete/{id}', ['as' => 'delete-product', 'uses' => 'ProductController@delete']);
});