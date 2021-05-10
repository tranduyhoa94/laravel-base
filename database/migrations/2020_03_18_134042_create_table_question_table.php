<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('topic_id');
            $table->string('name');
            $table->boolean('is_approved')->default(0);
            $table->string('type', 20);
            $table->unsignedBigInteger('quizz_id');
            $table->text('note');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('topic_id', 'topics_fk_questions_id_1')
                ->references('id')
                ->on('topics');
            $table->foreign('quizz_id', 'quizzes_fk_questions_id_1')
                ->references('id')
                ->on('quizzes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
