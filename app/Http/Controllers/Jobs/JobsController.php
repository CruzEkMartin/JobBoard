<?php

namespace App\Http\Controllers\Jobs;

use App\Models\Job\Job;
use App\Models\Job\JobSaved;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use App\Models\Job\Application;
use Illuminate\Support\Facades\Auth;

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

//save job
$savedJob = JobSaved::where('job_id', $id)
->where('user_id', Auth::user()->id)
->count();

//verifing if user applied to job
$appliedJob = Application::where('job_id', $id)
->where('user_id', Auth::user()->id)
->count();

//cateegories

$categories = Category::all();


        return view ('jobs.single', compact('job', 'relatedJobs', 'relatedJobsCount', 'savedJob', 'appliedJob', 'categories'));
    }

    public function saveJob(Request $request){

        $saveJob = JobSaved::create([
            'job_id' => $request->job_id,
            'user_id' => $request->user_id,
            'job_image' => $request->job_image,
            'job_title' => $request->job_title,
            'job_region' => $request->job_region,
            'job_type' => $request->job_type,
            'company' => $request->company,
        ]);

        if($saveJob){
            return redirect('/jobs/single/'.$request->job_id.'')->with('save','job saved successfully');
        }


    }

    public function applyJob(Request $request){
        if($request->cv == 'No cv'){
            return redirect('/jobs/single/'.$request->job_id.'')->with('apply','upload your cv first in the profile page');
        }
        else{
            $saveJob = Application::create([
                'cv' => Auth::user()->cv,
                'job_id' => $request->job_id,
                'user_id' => Auth::user()->id,
                'job_image' => $request->job_image,
                'job_title' => $request->job_title,
                'job_region' => $request->job_region,
                'job_type' => $request->job_type,
                'company' => $request->company,
            ]);
        }


        if($saveJob){
            return redirect('/jobs/single/'.$request->job_id.'')->with('applied','you applied to this job successfully');
        }
    }

}
