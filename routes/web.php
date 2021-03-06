<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('/register', 'AuthController@register');
    $router->post('/login', 'AuthController@login');

    $router->group(['prefix' => 'hosonhanvien'], function () use ($router) {
        $router->get('list', 'HosonhanvienController@list');
        $router->get('detail/{msdn}', 'HosonhanvienController@detail');
    });


    $router->group(['middleware' => 'auth'], function () use ($router) {
        $router->group(['prefix' => 'hosonhanvien'], function () use ($router) {
            $router->get('list', 'HosonhanvienController@list');
            $router->get('detail/{msdn}', 'HosonhanvienController@detail');
        });
        $router->group(['prefix' => 'dmphanloai'], function () use ($router) {
            $router->get('list', 'DMPhanloaiController@list');
            $router->post('list_phanloai', 'DMPhanloaiController@list_phanloai');
            $router->post('upload', 'DMPhanloaiController@store');
        });



        $router->post('/logout', 'AuthController@logout');
        $router->get('/posts', 'PostController@index');
        $router->post('/posts', 'PostController@store');
        $router->put('/posts/{id}', 'PostController@update');
        $router->delete('/posts/{id}', 'PostController@destroy');
    });
});
