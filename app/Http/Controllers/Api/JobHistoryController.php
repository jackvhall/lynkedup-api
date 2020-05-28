<?php

namespace App\Http\Controllers\Api;

use App\JobHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(\App\JobHistory::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JobHistory  $jobHistory
     * @return \Illuminate\Http\Response
     */
    public function show(JobHistory $jobHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JobHistory  $jobHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobHistory $jobHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JobHistory  $jobHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobHistory $jobHistory)
    {
        //
    }
}
