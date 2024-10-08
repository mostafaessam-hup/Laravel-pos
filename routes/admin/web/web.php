<?php

use Illuminate\Support\Facades\Route;

Route::get('logout', 'AuthController@logout')->name('logout');
Route::get('profile', 'AuthController@updateProfileView')->name('profile.view');
Route::put('profile', 'AuthController@updateProfile')->name('profile.post');

Route::get('home', 'HomeController@index')->name('home.index');

Route::resource('admins', 'AdminController');

Route::resource('users', 'UserController');
// Route::get('user/toggle-boolean/{id}/{action}', 'User\UserController@toggleBoolean')->name('users.toggleBoolean.active');

