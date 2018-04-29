<?php

/**
 * All route names are prefixed with 'admin.'.
 */
Route::get('dashboard', 'DashboardController@index')->name('dashboard');

/**
 *  Categories Management
 */
Route::group(['namespace' => 'Categories'], function () {
    Route::resource('categories', 'CategoriesController', ['except' => 
        ['show']]);

    //For DataTables
    Route::post('categories/get', 'CategoriesTableController')
        ->name('categories.get');
});

/**
 *  SubCategories Management
 */
Route::group(['namespace' => 'SubCategories'], function () {
    Route::resource('subcategories', 'SubCategoriesController', ['except' => 
        ['show']]);

    //For DataTables
    Route::post('subcategories/get', 'SubCategoriesTableController')
        ->name('subcategories.get');
});
