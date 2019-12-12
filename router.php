<?php
$app->get('/', function () {
    header('Location: /inicio');
});

$app->get('/inicio', 'CartorioController@index');
$app->post('/inicio', 'CartorioController@index');
$app->get('/cartorio/novo', 'CartorioController@create');
$app->post('/cartorio/inserir', 'CartorioController@store');
$app->post('/cartorio/detalhe', 'CartorioController@show');
$app->post('/cartorio/update', 'CartorioController@update');
$app->post('/cartorio/delete', 'CartorioController@delete');

$app->get('/novo-email', 'CartorioController@newEmail');
$app->post('/enviar-email', 'CartorioController@sendEmail');

$app->get('/arquivos/upload/xml', 'XMLController@index');
$app->post('/arquivos/importar/xml', 'XMLController@importar');

$app->get('/arquivos/upload/excel', 'ExcelController@index');
$app->post('/arquivos/importar/excel', 'ExcelController@importar');
$app->get('/arquivos/exportar/excel', 'ExcelController@exportar');
