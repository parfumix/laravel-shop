<?php

Route::group(['prefix' => 'admin/shop', 'as' => 'shop::', 'middleware' => 'role:admin', 'namespace' => 'Flysap\Media\Controllers\Admin'], function() {

    Route::get('products', ['as' => 'shop-products', 'uses' => 'ProductController@lists']);
});