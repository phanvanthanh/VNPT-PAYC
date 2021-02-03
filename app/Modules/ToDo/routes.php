<?php
$namespace = 'App\Modules\ToDo\Controllers';

Route::group(
    ['module'=>'ToDo', 'namespace' => $namespace, 'middleware'=>['web', 'auth','check-role']],
    function() {
        Route::get('to-do', [
            'as' => 'to-do',
            'uses' => 'ToDoController@toDo'
        ]);

        Route::post('danh-sach-to-do', [
            'as' => 'danh-sach-to-do',
            'uses' => 'ToDoController@danhSachToDo'
        ]);

        Route::post('them-to-do', [
            'as' => 'them-to-do',
            'uses' => 'ToDoController@themToDo'
        ]);

        Route::post('lay-to-do-theo-id', [
            'as' => 'lay-to-do-theo-id',
            'uses' => 'ToDoController@layToDoTheoId'
        ]);

        Route::post('cap-nhat-to-do', [
            'as' => 'cap-nhat-to-do',
            'uses' => 'ToDoController@capNhatToDo'
        ]);


        Route::post('xoa-to-do', [
            'as' => 'xoa-to-do',
            'uses' => 'ToDoController@xoaToDo'
        ]);
    }
);