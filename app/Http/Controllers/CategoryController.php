<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$categories = Category::all();

    	$data = [
    		'categories' => $categories,
    	];

    	return view('categories')->with($data);
    }
}
