<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableQuizSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_sessions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('quizz_id');
            $table->unsignedBigInteger('student_id');
            $table->string('type', 10);
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->dateTime('submited_at')->nullable();
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->boolean('is_completed')->default(0);
            $table->text('scope')->nullable();
            $table->timestamps();

            $table->foreign('quizz_id', 'quiz_sesstion_fk_quizzes_id_1')
                ->references('id')
                ->on('quizzes');
            $table->foreign('student_id', 'student_id_fk_quizzes_session_1')
                ->references('id')
                ->on('students');
            $table->foreign('teacher_id', 'teacher_id_fk_quizzes_session_1')
                ->references('id')
                ->on('teachers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_sessions');
    }
}
