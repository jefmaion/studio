<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->unsignedBigInteger('student_id')->nullable();
            $table->unsignedBigInteger('registration_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();


            $table->date('date')->nullable();
            $table->string('type', 2);
            $table->string('description', 500)->nullable();
            $table->decimal('value')->nullable();
            $table->decimal('fees')->default(0)->nullable();
            $table->decimal('amount')->nullable();
            $table->integer('status')->default(0);
            $table->date('pay_date')->nullable();
            $table->text('comments')->nullable();

            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('registration_id')->references('id')->on('registrations');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
