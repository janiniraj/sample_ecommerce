<?php

/**
 * All route names are prefixed with 'admin.'.
 */
Route::get('dashboard', 'DashboardController@index')->name('dashboard');
Route::get('test', 'DashboardController@test')->name('test');

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
    Route::get('subcategories/{id}/get', 'SubCategoriesController@getByCategory')
        ->name('subcategories.get-by-category');
});
Route::group(['namespace' => 'HomeSlider'], function () {
    Route::resource('home-slider', 'HomeSliderController', ['except' =>
        ['show']]);

    //For DataTables
    Route::post('home-slider/get', 'HomeSliderTableController')
        ->name('home-slider.get');
});

/**
 *  Style Management
 */
Route::group(['namespace' => 'Style'], function () {
    Route::resource('styles', 'StyleController', ['except' =>
        ['show']]);

    //For DataTables
    Route::post('styles/get', 'StyleTableController')
        ->name('styles.get');
});

/**
 *  Material Management
 */
Route::group(['namespace' => 'Material'], function () {
    Route::resource('materials', 'MaterialController', ['except' =>
        ['show']]);

    //For DataTables
    Route::post('materials/get', 'MaterialTableController')
        ->name('materials.get');
});

/**
 *  Weave Management
 */
Route::group(['namespace' => 'Weave'], function () {
    Route::resource('weaves', 'WeaveController', ['except' =>
        ['show']]);

    //For DataTables
    Route::post('weaves/get', 'WeaveTableController')
        ->name('weaves.get');
});

/**
 *  Color Management
 */
Route::group(['namespace' => 'Color'], function () {
    Route::resource('colors', 'ColorController', ['except' =>
        ['show']]);

    //For DataTables
    Route::post('colors/get', 'ColorTableController')
        ->name('colors.get');
});