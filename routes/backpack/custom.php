<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('user', 'UserCrudController');
    Route::crud('category', 'CategoryCrudController');
    Route::crud('post', 'PostCrudController');
    Route::crud('comment', 'CommentCrudController');
    Route::get('charts/weekly-users', 'Charts\WeeklyUsersChartController@response')->name('charts.weekly-users.index');
    Route::get('charts/sample-chart', 'Charts\SampleChartChartController@response')->name('charts.sample-chart.index');
    Route::get('charts/sample', 'Charts\SampleChartController@response')->name('charts.sample.index');
    Route::get('charts/visitor', 'Charts\VisitorChartController@response')->name('charts.visitor.index');
    Route::crud('menu', 'MenuCrudController');
    Route::crud('permissions', 'PermissionsCrudController');
    Route::crud('roles', 'RolesCrudController');
}); // this should be the absolute last line of this file