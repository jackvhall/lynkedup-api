<?php

namespace App\Http\Controllers\Api;

use App\JobHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\JobHistoryEntry;
use Illuminate\Validation\ValidationException;

class JobHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(auth()
            ->user()
            ->history
            ->entries()
            ->orderBy('start_date', 'desc')
            ->get(),
            200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'orgName' => 'required|string|max:128',
                'jobTitle' => 'required|string|max:128',
                'startDate' => 'date',
                'endDate' => 'date|nullable',
                'description' => 'string|max:255'
            ]);
            $entry = JobHistoryEntry::create([
                'job_history_id' => auth()->user()->history->id,
                'org_name' => $validated['orgName'],
                'job_title' => $validated['jobTitle'],
                'start_date' => new \DateTime($validated['startDate']),
                'end_date' => new \DateTime($validated['endDate']) ?? null,
                'description' => $validated['description']
            ]);
        } catch (ValidationException $e) {
            return response($e->getMessage(), $e->status);
        }

        return response([
            'message' => 'Entry created successfully.',
            'entry' => $entry
        ], 200);
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
    public function update(Request $request, JobHistoryEntry $jobHistoryEntry)
    {
        try {
            $validated = $request->validate([
                'orgName' => 'required|string|max:128',
                'jobTitle' => 'required|string|max:128',
                'startDate' => 'date',
                'endDate' => 'date|nullable',
                'description' => 'string|max:255'
            ]);
            $jobHistoryEntry->update([
                'org_name' => $validated['orgName'],
                'job_title' => $validated['jobTitle'],
                'start_date' => new \DateTime($validated['startDate']),
                'end_date' => new \DateTime($validated['endDate']) ?? null,
                'description' => $validated['description']
            ]);
        } catch (ValidationException $e) {
            return response($e->getMessage(), $e->status);
        }

        return response([
            'message' => 'Entry created successfully.',
            'entry' => $jobHistoryEntry
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JobHistory  $jobHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobHistoryEntry $jobHistoryEntry)
    {
        $jobHistoryEntry->delete();
        return response(['message' => 'Entry deleted successfully.'], 200);
    }
}
