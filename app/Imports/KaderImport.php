<?php

namespace App\Imports;

use App\Profile;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;


class KaderImport implements ToModel, WithStartRow
{
    /**
     * @return int
     */
    public function startRow(): int
    {
    	return 2;
    }

    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
    	return new Profile([
    		'nop' => $row[1],
    		'alamat' => $row[2],
    		'rt_rw' => $row[3],
    		'luas_tanah' => $row[4],
    		'luas_bangunan' => $row[5],
    		'persil' => $row[6],
    		'c' => $row[7],
    		'nama_wp' => $row[8],
    		'alamat_wp' => $row[9],
    		'rt_rw_wp' => $row[10],
    		'kelurahan' => $row[11],
    		'kota' => $row[12],
    		'pbb' => $row[13],
    		'lat' => $row[14],
    		'longi' => $row[15],
    	]);
    }
}
