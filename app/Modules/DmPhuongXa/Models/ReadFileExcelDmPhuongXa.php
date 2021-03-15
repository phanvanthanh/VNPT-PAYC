<?php

namespace App\Modules\DmPhuongXa\Models;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\DmPhuongXa;

class ReadFileExcelDmPhuongXa implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DmPhuongXa([
            'MA_PHUONG_XA'     => $row['ma_phuong_xa'],
            'TEN_PHUONG_XA'     => $row['ten_phuong_xa'],
            'LOAI'     => $row['loai'],
            'MA_QUAN_HUYEN'     => $row['ma_quan_huyen'], 
        ]);
    }
}