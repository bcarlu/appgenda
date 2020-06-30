<?php

namespace App\Http\Controllers;
use App\Service;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($category)
    {
    	   
        $services = Service::where('id_category', $category)->get();

    	$data = [
    		'services' => $services,
    	];

    	return view('services')->with($data);
    }
}
