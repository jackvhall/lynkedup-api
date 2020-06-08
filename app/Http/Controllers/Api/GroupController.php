<?php

namespace App\Http\Controllers\Api;

use App\Group;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Group::all(), 200);
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
        $group = Group::create($request->validate([
            'name' => 'string|max:128',
            'image_url' => 'string|url|nullable',
            'description' => 'string|max:255|nullable'
        ]));

        return response([
            'message' => 'Group successfully created.',
            'group' => $group
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        //
    }

    public function join(Group $group)
    {
        try {
            if (auth()->user()->groups->contains($group)) {
                throw new \Exception('User already in group', 400);
            }
            $group->users()->save(auth()->user());
            return response([
                'message' => 'Added to group.',
                'group' => $group
            ], 200);
        } catch(\Exception $e) {
            return response(['message' => $e->getMessage()], $e->getCode());
        }
    }

    public function me()
    {
        return response([
            'groups' => auth()->user()->groups
        ], 200);
    }
}
