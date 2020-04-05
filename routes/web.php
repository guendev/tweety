<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware('auth')->group(function (){
    Route::prefix('/tweets')->group(function (){
        Route::get('', 'TweetController@index')->name('tweets');
        Route::post('/{id}','TweetController@tweet')->name('tweet');
    });

    Route::prefix('/profile')->group(function (){
        Route::prefix('/{user}')->group(function (){
            Route::get('','ProfileController@index')->name('profile');
            Route::post('/follow','FollowController@action')->name('follow');
            Route::get('/edit','ProfileController@edit');
        });
    });

});




Auth::routes();
