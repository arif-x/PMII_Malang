<?php

namespace App\Http\Controllers\AdminRayon\Export;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\AdminRayon\KaderExport;

class KaderController extends Controller
{
	public function export(){		
		return (new KaderExport)->download('kader.xlsx');
	}
}
