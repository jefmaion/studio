<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('classes_id')->nullable();
            $table->unsignedBigInteger('registration_id')->nullable();
            $table->unsignedBigInteger('modality_id')->nullable();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('instructor_id');
            $table->unsignedBigInteger('scheduled_instructor_id');
            

            $table->date('date');
            $table->time('time');
            $table->integer('weekday')->nullable();
            $table->string('type')->nullable();
            $table->integer('status')->default(0);
            $table->integer('finished')->default(0);
            $table->decimal('value')->nullable();
            $table->text('comments')->nullable();
            $table->text('absense_comments')->nullable();
            $table->text('evolution')->nullable();

            $table->integer('has_replacement')->nullable()->default(0);
            $table->date('replacement_limit')->nullable();

            $table->foreign('classes_id')->references('id')->on('classes');
            $table->foreign('registration_id')->references('id')->on('registrations');
            $table->foreign('modality_id')->references('id')->on('modalities');
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('instructor_id')->references('id')->on('instructors');
            $table->foreign('scheduled_instructor_id')->references('id')->on('instructors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes');
    }
}
