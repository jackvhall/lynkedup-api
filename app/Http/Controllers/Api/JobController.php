<?php

namespace App\Http\Controllers\Api;

use App\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'jobs' => Job::all()
            ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $job = Job::create($request->validate([
            'title' => 'required',
            'organization' => 'required',
            'description' => 'required',
            'salary_start' => 'required',
            'salary_end' => 'required',
            'type' => 'required'
        ]));

        return response([
            'job' => $job,
            'message' => 'Job posted successfully.'
        ], 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        $job->users()->save(auth()->user());
        return response([
            'job' => $job,
            'message' => 'Application successfully saved.'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        //
    }

    public function myJobs()
    {
        return response([
            'jobs' => auth()->user()->jobs
        ], 200);
    }
}
