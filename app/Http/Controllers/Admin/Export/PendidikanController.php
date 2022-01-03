<?php

namespace App\Http\Controllers\Admin\Export;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\Admin\PendidikanExport;

class PendidikanController extends Controller
{
    public function export(){		
		return (new PendidikanExport)->download('pendidikan.xlsx');
	}
}
