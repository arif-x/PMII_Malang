<?php

namespace App\Http\Controllers\Admin\Export;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\Admin\KaderExport;

class KaderController extends Controller
{
	public function export(){		
		return (new KaderExport)->download('kader.xlsx');
	}
}
