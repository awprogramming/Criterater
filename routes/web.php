<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::middleware('auth')->group(function(){
    Route::get('/','CriteratingController@index');
    //Route::resource('criteratings','CriteratingController');
    Route::get('/criteratings','CriteratingController@index')->name('criteratings');
    Route::get('/criteratings/mine/{user_id}','CriteratingController@myCriteratings')->name('my_criteratings');
    Route::get('/criteratings/new', 'CriteratingController@newCriterating')->name('new_criterating');
    Route::post('/criteratings/new', 'CriteratingController@newCriterating')->name('create_criterating');
    //this route shows the average
    Route::get('/criteratings/{criterating_id}', 'CriteratingController@show')->name('show_criterating');
    Route::delete('/criteratings/{criterating_id}', 'CriteratingController@delete')->name('delete_criterating');
    Route::put('/criteratings/{criterating_id}', 'CriteratingController@edit')->name('edit_criterating');
    Route::post('/criteratings/{criterating_id}', 'CriteratingController@modify')->name('update_criterating');
    
    

    Route::get('/criteratings/{criterating_id}/criteria', 'CriterionController@edit')->name('edit_criteria');
    Route::post('/criteratings/{criterating_id}/criteria', 'CriterionController@modify')->name('update_criteria');
    Route::delete('/criteratings/{criterating_id}/criteria/delete/{criterion_id}','CriterionController@delete')->name('delete_criterion');

    Route::get('/criteratings/{criterating_id}/items/new', 'ItemController@newItem')->name('new_item');
    Route::post('/criteratings/{criterating_id}/items/new', 'ItemController@newItem')->name('create_item');
    Route::get('/criteratings/{criterating_id}/items/{item_id}', 'ItemController@edit')->name('edit_item');
    Route::post('/criteratings/{criterating_id}/items/{item_id}', 'ItemController@modify')->name('update_item');

    Route::get('/criteratings/{criterating_id}/items/{item_id}/rate','ItemController@rate')->name('rate_item');
    Route::post('/criteratings/{criterating_id}/items/{item_id}/rate','ItemController@rate')->name('save_ratings');
    //this route shows user ratings
    Route::get('/criteratings/{criterating_id}/{user_id}', 'CriteratingController@showMine')->name('show_my_criterating');
});


