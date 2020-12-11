<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('date');
            $table->string('time');
            $table->string('client_name');
            $table->string('client_address');
            $table->string('client_phone');
            $table->string('form_type');
            $table->string('form_link');
            $table->text('notes');
            $table->text('notes_by_employee')->nullable();
            $table->string('status')->nullable();
            $table->datetime('job_completion')->nullable();
            $table->integer('employee_id');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
