<?php

namespace App\Http\Controllers\Admin\Export;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\Admin\PostinganExport;

class PostController extends Controller
{
	public function export(){		
		return (new PostinganExport)->download('post.xlsx');
	}
}
