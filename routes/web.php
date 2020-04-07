<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


    Route::middleware(['auth'])->prefix('')->group(function (){
        Route::get('', 'TweetController@index')->name('tweets');
        Route::get('getmore', 'TweetController@newsfeed');
        Route::post('tweet/{id}','TweetController@tweet')->name('tweet');
    });

    Route::middleware(['auth'])->prefix('/tweet')->group(function (){
        Route::get('/authorinfo', 'TweetController@authorinfo');
    });

    Route::middleware(['auth'])->prefix('/tweets')->group(function (){
        Route::get('/loadmore','ProfileController@infinity');
        Route::prefix('/{user}')->group(function (){
            Route::get('','ProfileController@index')->name('User');
            Route::get('/edit','ProfileController@edit');
        });
    });

    Route::middleware(['auth'])->post('/{user}/follow','FollowController@action')->name('follow');




Auth::routes();
