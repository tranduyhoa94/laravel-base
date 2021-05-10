<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLimitTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('limit_tests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('times')->default(0);
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('student_id');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->timestamps();

            $table->foreign('subject_id', 'limit_test_fk_subject_id_1')
                ->references('id')
                ->on('subjects');

            $table->foreign('student_id', 'limit_test_fk_student_id_1')
                ->references('id')
                ->on('students');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('limit_tests');
    }
}
