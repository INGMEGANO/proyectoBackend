<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id');
            $table->string('name_prefix');
            $table->string('middle_initial');
            $table->string('gender');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('mother_maiden_name');
            $table->string('date_of_birth');
            $table->string('date_of_joining');
            $table->double('salary', 10, 2);
            $table->string('ssn');
            $table->string('phone');
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->foreign('manager_id')->references('id')->on('managers');
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
        Schema::dropIfExists('employees');
    }
}
