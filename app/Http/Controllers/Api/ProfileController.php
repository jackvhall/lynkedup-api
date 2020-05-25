<?php

namespace App\Http\Controllers\Api;

use App\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Profile::all(), 200);
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
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile, Request $request)
    {

        return auth()->user()->profile;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!$profile = auth()->user()->profile) {
            $profile = Profile::create(['user_id' => auth()->user()->id]);
        } else {
            $profile = auth()->user()->profile;
        }

        try {
            $profile->update([
                'status' => $request->status,
                'job_title' => $request->jobTitle,
                'about' => $request->about,
                'street' => $request->street,
                'city' => $request->city,
                'state' => explode(' ', $request->state)[0],
                'zip' => $request->zip
            ]);
        } catch (\Exception $e) {
            return response(['error' => $e->getMessage()], $e->getCode());
        }

        return response([
            'message' => 'Profile updated.'
        ] ,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
