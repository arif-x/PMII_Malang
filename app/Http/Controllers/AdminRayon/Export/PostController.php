<?php

namespace App\Http\Controllers\AdminRayon\Export;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\AdminRayon\PostinganExport;

class PostController extends Controller
{
	public function export(){		
		return (new PostinganExport)->download('post.xlsx');
	}
}
