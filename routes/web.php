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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::prefix('admin')->namespace('Admin')->group(function(){
    //public routes
    Route::get('login', 'AuthController@form')->name('login');
    Route::post('login', 'AuthController@login')->name('admin.login');

    //private routes
    Route::middleware('auth')->group(function() {
        Route::get('', 'HomeController@index')->name('admin.home');
        Route::get('logout', 'AuthController@logout')->name('logout');
        Route::get('profile', 'HomeController@profileForm')->name('profile.form');
        Route::post('profile', 'HomeController@profileSave')->name('profile.save');
        Route::post('profile/changePassword', 'HomeController@changePassword')->name('profile.changePassword');
        //services routes
        Route::prefix('services')->group(function(){
            //services types
            Route::get('/', 'ServiceController@listServices')->name('admin.service.list');
            // Route::get('add', 'ServiceController@addType')->name('admin.service-type.add');
            // Route::post('save/{serviceType?}', 'ServiceController@saveType')->name('admin.service-type.save');
            // Route::get('edit/{serviceType}', 'ServiceController@editType')->name('admin.service-type.edit');
            // Route::get('delete/{serviceType}', 'ServiceController@deleteType')->name('admin.service-type.delete');
            Route::prefix('types')->group(function(){
                Route::get('/', 'ServiceController@listTypes')->name('admin.service-type.list');
                Route::get('add', 'ServiceController@addType')->name('admin.service-type.add');
                Route::post('save/{serviceType?}', 'ServiceController@saveType')->name('admin.service-type.save');
                Route::get('edit/{serviceType}', 'ServiceController@editType')->name('admin.service-type.edit');
                Route::get('delete/{serviceType}', 'ServiceController@deleteType')->name('admin.service-type.delete');
            });
            //services
        });
        // Route::prefix('users')->group(function(){
        //     //users routes
        //     Route::get('', 'UserController@listUsers')->name('user.listUsers');
        //     Route::get('add', 'UserController@addUser')->name('user.addUser');
        //     Route::get('edit/{user}', 'UserController@editUser')->name('user.editUser');
        //     Route::post('save/{user?}', 'UserController@saveUser')->name('user.saveUser');
        //     Route::get('delete/{user}', 'UserController@deleteUser')->name('user.deleteUser');
        //     //users groups routes
        //     Route::prefix('groups')->group(function(){
        //         Route::get('/', 'UserController@listGroups')->name('user.listGroups');
        //         Route::get('add', 'UserController@addGroup')->name('user.addGroup');
        //         Route::get('edit/{group}', 'UserController@editGroup')->name('user.editGroup');
        //         Route::post('save/{group?}', 'UserController@saveGroup')->name('user.saveGroup');
        //         Route::get('delete/{group}', 'UserController@deleteGroup')->name('user.deleteGroup');
        //     });
        //     //users roles routes
        //     Route::prefix('roles')->group(function(){
        //         Route::get('/', 'UserController@listRoles')->name('user.listRoles');
        //         Route::get('add', 'UserController@addRole')->name('user.addRole');
        //         Route::get('edit/{role}', 'UserController@editRole')->name('user.editRole');
        //         Route::post('save/{role?}', 'UserController@saveRole')->name('user.saveRole');
        //         Route::get('delete/{role}', 'UserController@deleteRole')->name('user.deleteRole');
        //     });
        //     //ajax routes
        //     Route::prefix('ajax')->group(function(){
        //         Route::post('getPerms/{group?}/{role?}', 'UserController@getPerms');
        //         Route::post('getRoles/{group}/{user?}', 'UserController@getRoles');
        //     });
        // });
    });
});

