<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\JobHistory;
use App\JobHistoryEntry;

class JobHistoryTest extends TestCase
{

    use WithFaker, RefreshDatabase;

    public function test_a_user_has_a_job_history()
    {
        $user = factory('App\User')->create();

        $jobHistory = JobHistory::create(['user_id' => $user->id]);

        $this->assertDatabaseHas('job_histories', ['user_id' => $user->id]);
    }

    public function test_a_job_history_has_entries()
    {
        $user = factory('App\User')->create();

        $jobHistory = JobHistory::create(['user_id' => $user->id]);

        $this->assertDatabaseHas('job_histories', ['user_id' => $user->id]);
    }
}
