<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class menuController extends Controller
{

    
	public function links() {
		
	    $links = [
	        ['name' => 'jobs', 'url' => url('jobs') ],
	        ['name' => 'series', 'url' => url('series') ],
	        ['name' => 'courses', 'url' => url('courses') ],
	    ];
	    return $links;
	}
	

}
