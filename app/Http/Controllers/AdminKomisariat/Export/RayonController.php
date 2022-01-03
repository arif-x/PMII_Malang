<?php

namespace App\Http\Controllers\AdminKomisariat\Export;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\AdminKomisariat\RayonExport;

class RayonController extends Controller
{
    public function export(){		
		return (new RayonExport)->download('rayon.xlsx');
	}
}