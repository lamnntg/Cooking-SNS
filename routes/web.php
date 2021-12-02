<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
//overide login route
Route::post('/login', 'Auth\LoginController@login')->middleware('checkstatus');

Route::prefix('login')->name('login.')->group(function () {
    Route::get('/{provider}', 'Auth\LoginController@redirectToProvider')->name('{provider}');
    Route::get('/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('{provider}.callback');
});
Route::prefix('register')->name('register.')->group(function () {
    Route::get('/{provider}', 'Auth\RegisterController@showProviderUserRegistrationForm')->name('{provider}');
    Route::post('/{provider}', 'Auth\RegisterController@registerProviderUser')->name('{provider}');
});

Route::middleware(['auth', 'checkstatus'])->group(function () {
    Route::get('/', 'RecipeController@index')->name('recipes.index');
    Route::resource('/recipes', 'RecipeController')->except(['index', 'show']);
    Route::resource('/recipes', 'RecipeController')->only(['show']);

    Route::prefix('recipes')->name('recipes.')->group(function () {
        Route::put('/{recipe}/like', 'RecipeController@like')->name('like');
        Route::delete('/{recipe}/like', 'RecipeController@unlike')->name('unlike');
    });
    Route::get('/tags/{name}', 'TagController@show')->name('tags.show');

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/{name}', 'UserController@show')->name('show');
        Route::get('/{name}/likes', 'UserController@likes')->name('likes');
        Route::get('/{name}/followings', 'UserController@followings')->name('followings');
        Route::get('/{name}/followers', 'UserController@followers')->name('followers');
        //follow
        Route::put('/{name}/follow', 'UserController@follow')->name('follow');
        Route::delete('/{name}/follow', 'UserController@unfollow')->name('unfollow');
    });

    Route::get('/profile', 'UserController@profile')->name('profile.index');
    Route::get('/profile/edit', 'UserController@edit')->name('profile.edit');
});

Route::get('/block', function () {
    return view('block');
});

Route::get('/home', function () {
    return view('home');
})->name('home');
