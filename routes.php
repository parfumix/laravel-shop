<?php

Route::group(['prefix' => 'admin/shop', 'as' => 'shop::', 'middleware' => 'role:admin', 'namespace' => 'Flysap\Shop\Controllers\Admin'], function() {

    Route::get('products', ['as' => 'shop-products', 'uses' => 'ProductController@lists']);
});