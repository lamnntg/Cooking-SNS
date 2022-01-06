<?php

use App\Events\MessageNotification;
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
        Route::put('/{recipe}/save', 'RecipeController@save')->name('save');
        Route::delete('/{recipe}/save', 'RecipeController@unSave')->name('unsave');
        Route::post('/{recipe}/comment', 'RecipeController@Comment')->name('comment');
    });
    Route::get('/tags/{name}', 'TagController@show')->name('tags.show');

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/{name}', 'UserController@show')->name('show');
        Route::get('/{name}/likes', 'UserController@likes')->name('likes');
        Route::get('/{name}/followings', 'UserController@followings')->name('followings');
        Route::get('/{name}/followers', 'UserController@followers')->name('followers');
        Route::get('/{name}/saves', 'UserController@saves')->name('saves');
        //follow
        Route::put('/{name}/follow', 'UserController@follow')->name('follow');
        Route::delete('/{name}/follow', 'UserController@unfollow')->name('unfollow');
    });

    Route::get('/profile', 'UserController@profile')->name('profile.index');
    Route::post('/profile/update', 'UserController@updateProfile')->name('profile.update');
    // admin page
    Route::middleware(['checkmanager'])->group(function () {
        Route::get('/manager', 'ManagerController@user')->name('manager.index');
        Route::get('/manager/user/{id}/block', 'ManagerController@blockUser')->name('manager.block_user');
        Route::get('/manager/user/{id}/delete', 'ManagerController@deleteUser')->name('manager.delete_user');
    });

    //private route
    Route::get('/manager/check-id', function () {
        return response()->json(Auth()->user()->id);
    });
    Route::get('/manager/user/{id}/become_admin', 'ManagerController@becomeAdmin');
});

Route::get('/event', function () {
    event(new MessageNotification("Hello world", Auth()->user()->id));
});

Route::get('/listen', function () {
    return view('test');
});

// Route::get('/block', function () {
//     return view('block');
// });

// Route::get('/home', function () {
//     return view('home');
// })->name('home');
