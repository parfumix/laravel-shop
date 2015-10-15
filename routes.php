<?php

Route::group(['prefix' => 'admin/shop', 'as' => 'shop::', 'middleware' => 'role:admin'], function() {

});