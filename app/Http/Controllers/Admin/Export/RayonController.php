<?php

namespace App\Http\Controllers\Admin\Export;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\Admin\RayonExport;

class RayonController extends Controller
{
    public function export(){		
		return (new RayonExport)->download('rayon.xlsx');
	}
}
