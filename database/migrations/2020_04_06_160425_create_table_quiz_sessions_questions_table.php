<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableQuizSessionsQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_session_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('quiz_session_id');
            $table->unsignedBigInteger('question_id');
            $table->text('choose_answers')->nullable();
            $table->text('content_answers')->nullable();
            $table->boolean('is_correct')->default(0);
            $table->text('note')->nullable();
            $table->timestamps();

            $table->foreign('quiz_session_id', 'quiz_sessions_fk_quiz_session_questions_id_1')
                ->references('id')
                ->on('quiz_sessions');
            $table->foreign('question_id', 'question_id_fk_quiz_session_questions_id_1')
                ->references('id')
                ->on('questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_session_questions');
    }
}
