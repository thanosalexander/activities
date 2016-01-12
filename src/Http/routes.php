<?php


/**
 * Activities Routes
 */

Route::group(['middleware'=> 'auth'], function()
{

    /**
     * Activities Routes
     */
    Route::get('activities',array(
        'uses'=>'thanosalexander\activity\Http\Controllers\ActivityController@index',
        'as'=>'activities.index'
    ));
    Route::post('activities/create',array(
        'uses'=>'thanosalexander\activity\Http\Controllers\ActivityController@store',
        'as'=>'activities.store'
    ));
    Route::put('activities/update/{id}',array(
        'uses'=>'thanosalexander\activity\Http\Controllers\ActivityController@update',
        'as'=>'activities.update'
    ));
    Route::get('activities/show/{id}',array(
        'uses'=>'thanosalexander\activity\Http\Controllers\ActivityController@show',
        'as'=>'activities.show'
    ));
    Route::delete('activities/delete/{id}',array(
        'uses'=>'thanosalexander\activity\Http\Controllers\ActivityController@delete',
        'as'=>'activities.delete'
    ));

    /**
     * Types Routes
     */
    Route::get('types',array(
        'uses'=>'thanosalexander\activity\Http\Controllers\TypeController@index',
        'as'=>'types.index'
    ));
    Route::post('types/create',array(
        'uses'=>'thanosalexander\activity\Http\Controllers\TypeController@store',
        'as'=>'types.store'
    ));
    Route::put('types/update/{id}',array(
        'uses'=>'thanosalexander\activity\Http\Controllers\TypeController@update',
        'as'=>'types.update'
    ));
    Route::get('types/show/{id}',array(
        'uses'=>'thanosalexander\activity\Http\Controllers\TypeController@show',
        'as'=>'types.show'
    ));
    Route::delete('types/delete/{id}',array(
        'uses'=>'thanosalexander\activity\Http\Controllers\TypeController@delete',
        'as'=>'types.delete'
    ));


});

