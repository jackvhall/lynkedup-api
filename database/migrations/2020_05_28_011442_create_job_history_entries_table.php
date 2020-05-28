<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobHistoryEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_history_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_histories_id');
            $table->string('org_name');
            $table->string('job_title');
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable(true);
            $table->text('description');
            $table->timestamps();

            $table->foreign('job_histories_id')->references('id')->on('job_histories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_history_entries');
    }
}
