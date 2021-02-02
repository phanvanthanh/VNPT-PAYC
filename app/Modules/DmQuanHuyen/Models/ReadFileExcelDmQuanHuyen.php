<?php

namespace App\Modules\DmQuanHuyen\Models;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\DmQuanHuyen;

class ReadFileExcelDmQuanHuyen implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        print_r($row);
        return new DmQuanHuyen([
            'MA_QUAN_HUYEN'     => $row['ma_quan_huyen'],
            'TEN_QUAN_HUYEN'     => $row['ten_quan_huyen'],
            'LOAI'     => $row['loai'],
            'MA_TINH'     => $row['ma_tinh'], 
        ]);
    }
}