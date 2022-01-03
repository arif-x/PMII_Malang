<?php

namespace App\Http\Controllers\AdminKomisariat\Export;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\AdminKomisariat\PostinganExport;

class PostController extends Controller
{
	public function export(){		
		return (new PostinganExport)->download('post.xlsx');
	}
}
