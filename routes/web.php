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


# route to display the form for the A3 app - Bill Splitter 
Route::get('/', 'FormController@index');

# route to process the form for the A3 app - Bill Splitter 
Route::get('/formSubmit', 'FormController@process');

/**
* Test Debugbar package, with a route /debugbar to show it is enabled
*/
Route::get('/debugbar', function() {

    $data = Array('foo' => 'bar');
    Debugbar::info($data);
    Debugbar::info('Current environment: '.App::environment());
    Debugbar::error('Error!');
    Debugbar::warning('Watch out…');
    Debugbar::addMessage('Another message', 'mylabel');

    return 'Just demoing some of the features of Debugbar';

});

# route to PracticeController for testing practice examples
Route::any('/practice/{n?}', 'PracticeController@index');

/*
* Test laravel-log-viewer package, with a route /logs that's only accessible locally.
*/
if(config('app.env')=='local'){
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
}
