<?php

namespace App\Http\Controllers\AdminKomisariat\Export;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\AdminKomisariat\KaderExport;

class KaderController extends Controller
{
	public function export(){		
		return (new KaderExport)->download('kader.xlsx');
	}
}
