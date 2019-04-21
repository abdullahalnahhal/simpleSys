<?php
    Route::get('/','UsersController@index')->name('index');
    Route::get('/new','UsersController@new')->name('new');

    Route::get('{id}','UsersController@view')->name('view');
    Route::get('{id}/edit','UsersController@edit')->name('edit');
    Route::get('{id}/delete','UsersController@delete')->name('delete');

    Route::post('/new','UsersController@add')->name('add');
    Route::post('{id}/update','UsersController@update')->name('update');

?>
