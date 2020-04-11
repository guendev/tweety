<?php

use App\Models\Tweet;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


    Route::middleware(['auth'])->prefix('')->group(function (){
        Route::get('', 'TweetController@index')->name('tweets');
        Route::get('discovery', 'TweetController@discovery')->name('discovery');
        Route::get('getmore', 'TweetController@newsfeed');
        Route::post('tweet/{id}','TweetController@tweet')->name('tweet');
        Route::get('get-recommend', 'RecommendController@getYourFriends');
        Route::post('changePass', 'ProfileController@changePassword');
        Route::post('changeProfileImg', 'ProfileController@changeProfileImg');
        Route::get('get-discovery', 'DiscoveryController@get');
        Route::get('get-count-tweets', function (Request $request){
          return  Tweet::where('user_id', $request['user_id'])->count();
        });
    });

    Route::middleware(['auth'])->prefix('/tweet')->group(function (){
        Route::get('/authorinfo', 'TweetController@authorinfo');
    });

    Route::middleware(['auth'])->group(function (){
        Route::get('/tweets/loadmore','ProfileController@infinity');
        Route::prefix('@{user}')->group(function (){
            Route::get('','ProfileController@index')->name('User');
            Route::patch('/edit', 'ProfileController@update')->name('updateProfile');
        });
        Route::get('/get-user','ProfileController@getUserInfo');
        Route::post('/update-profile', 'ProfileController@update');
    });

    Route::middleware(['auth'])->post('/{user}/follow','FollowController@action')->name('follow');




Auth::routes();
