<?php

namespace App\Http\Controllers\Categories;

use App\Models\Job\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    //

    public function singleCategory($name)
    {

        $categories = Job::where('category', $name)
        ->take(5)
        ->orderby('created_at', 'desc')
        ->get();

        return view('categories.single', compact('categories', 'name'));

    }
}
