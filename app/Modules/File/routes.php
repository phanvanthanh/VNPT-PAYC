<?php
$namespace = 'App\Modules\File\Controllers';
use Illuminate\Support\Facades\Storage;

Route::group(
    ['module'=>'File', 'namespace' => $namespace, 'middleware'=>['web']],
    function() {
        Route::get('file/download/{name}.{type}', function ($name, $type) {
            if (file_exists(storage_path('app/public/file/payc/'.$name.'.'.$type))) {
                return Storage::download('public/file/payc/'.$name.'.'.$type); 
            }else{
                return 'Lỗi, Không tìm thấy tệp tin cần tải.';
            }
                       
        },['uses' => 'FileController@download']);
    }


);