<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('login', 'AuthController@login');
$router->post('register', 'AuthController@register');


$router->get('api/posts/getAllPosts', 'PostController@fetchAllPosts');
$router->get('api/posts/fetchByPostsID/{postID}', 'PostController@fetchByPostsID');

$router->group(['prefix'=>'api/users', 'middleware'=>'auth'], function () use ($router) {
    $router->post('/userDetail', 'AuthController@me');

});

$router->group(['prefix'=>'api/posts', 'middleware'=>'auth'], function () use ($router) {

     $router->post('/createPost', 'PostController@createPosts');
     $router->put('/updatePost/{id}', 'PostController@updatePosts');
     $router->delete('/deletePost/{id}', 'PostController@deletePost');
     $router->delete('/deleteAllPosts', 'PostController@deleteAllPosts');

});
