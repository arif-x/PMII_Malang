<?php

namespace App\Http\Controllers\Admin\Export;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\Admin\KomisariatExport;

class KomisariatController extends Controller
{
    public function export(){		
		return (new KomisariatExport)->download('komisariat.xlsx');
	}
}
