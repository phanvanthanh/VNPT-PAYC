<?php
$namespace = 'App\Modules\File\Controllers';
use Illuminate\Support\Facades\Storage;

Route::group(
    ['module'=>'File', 'namespace' => $namespace, 'middleware'=>['web']],
    function() {
        Route::get('file/download/{name}.{type}', function ($name, $type) {
            return Storage::download('public/file/payc/'.$name.'.'.$type);            
        },['uses' => 'FileController@download']);
    }


);