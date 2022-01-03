<?php

namespace App\Http\Controllers\Admin\Export;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\Admin\PekerjaanExport;

class PekerjaanController extends Controller
{
    public function export(){		
		return (new PekerjaanExport)->download('pekerjaan.xlsx');
	}
}
