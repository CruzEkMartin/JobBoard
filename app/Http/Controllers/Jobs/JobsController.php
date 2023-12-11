<?php

namespace App\Http\Controllers\Jobs;

use App\Http\Controllers\Controller;
use App\Models\Job\Job;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    //

    public function single($id){

        $job = Job::find($id);

        $relatedJobs = Job::where('category', $job->category)
        ->where('id', '!=', $id)
        ->take(5)
        ->get();

        $relatedJobsCount =  $relatedJobs->count();

        return view ('jobs.single', compact('job', 'relatedJobs', 'relatedJobsCount'));
    }

    public function saveJob(){

    }

}
