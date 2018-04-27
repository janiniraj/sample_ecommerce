<?php
/*
 * Product Management
 */
Route::group(['namespace' => 'Product'], function () {
    Route::resource('product', 'ProductController', ['except' => ['show']]);

    //For DataTables
    Route::post('product/get', 'ProductTableController')->name('product.get');
});