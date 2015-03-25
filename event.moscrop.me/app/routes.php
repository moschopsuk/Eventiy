<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*
 *   Main entry point for the events front site
 */
Route::get('/', function()
{
	return View::make('main/index');
});

/*main entry point for any screens
 *		
 */
Route::put('api/v1/screen', array(
    'as' => 'screen',
    'uses' => 'ScreenController@putScreen')
);

Route::get('api/v1/event/{id}/{type}/{limit}/posts', array(
    'as' => 'fetch-posts-type',
    'uses' => 'PostController@getPostsSpec')
);

/*
 *    Main entry point for api calls from the main site to
 *    backend server systems
 */
Route::group(array('prefix' => 'api/v1/', 'before' => 'header-csrf'), function()
{
    Route::get('auth/session', array(
        'as' => 'session',
        'uses' => 'AuthController@getSession')
    );

    Route::post('auth/login', array(
        'as' => 'login',
        'uses' => 'AuthController@postLogin')
    );

    Route::get('auth/logout', array(
        'as' => 'logout',
        'uses' => 'AuthController@getlogout')
    );

    Route::post('auth/register', array(
        'as' => 'register',
        'uses' => 'AuthController@postRegister')
    );

    Route::get('events', array(
        'as' => 'list-events',
        'uses' => 'EventIndexController@getLiveEvents')
    );

    Route::get('event/{id}', array(
        'as' => 'list-event',
        'uses' => 'EventIndexController@getSingleLiveEvents')
    );

    Route::get('archived', array(
        'as' => 'list-archived-events',
        'uses' => 'EventIndexController@getArchived')
    );

    Route::get('event/{id}/posts', array(
        'as' => 'fetch-posts',
        'uses' => 'PostController@getPosts')
    );

    Route::get('event/{id}/posts/{page}', array(
        'as' => 'fetch-posts',
        'uses' => 'PostController@getPostsScoll')
    );

    Route::post('tweets', array(
        'as' => 'fetch-tweets',
        'uses' => 'TweetController@postTweets')
    ); 
});
/*
 *    Main entry point for api calls that require
 *    user to be loged in.
 */
Route::group(array('prefix' => 'api/v1/', 'before' => 'basicAuth|header-csrf'), function()
{
    Route::post('post/new', array(
        'as' => 'new-post',
        'uses' => 'PostController@postAdd')
    );
});
/*
 *    Main entry point for the admin dashboard
 */
Route::group(array('before' => 'basicAuth|hasPerm', 'prefix' => Config::get('syntara::config.uri')), function()
{
    /**
     * Events routes
     */
    Route::get('events', array(
        'as' => 'view-list-events',
        'uses' => 'EventController@getIndex')
    );

    Route::delete('event/{userId}', array(
        'as' => ' delete-event',
        'uses' => 'EventController@delete')
    );

    Route::post('event/new', array(
        'as' => 'create-event',
        'uses' => 'EventController@postCreate')
    );

    Route::get('event/new', array(
        'as' => 'create-event',
        'uses' => 'EventController@getCreate')
    );

    Route::get('event/{userId}', array(
        'as' => 'show-event',
        'uses' => 'EventController@getShow')
    );

    Route::put('event/{userId}', array(
        'as' => 'update-event',
        'uses' => 'EventController@putShow')
    );

    /**
     * Screens routes
     */
    Route::get('screens', array(
        'as' => 'view-screens',
        'uses' => 'ScreenDashController@getIndex')
    );

    Route::get('screen/{userId}', array(
        'as' => 'show-screen',
        'uses' => 'ScreenDashController@getShow')
    );

    Route::put('screen/{userId}', array(
        'as' => 'update-screen',
        'uses' => 'ScreenDashController@putShow')
    );
});