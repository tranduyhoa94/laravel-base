<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateForeignTableAnswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('answers', function (Blueprint $table) {
            $table->dropForeign('answers_fk_question_id_1');

            $table->foreign('question_id', 'answers_fk_question_id_2')
                ->references('id')
                ->on('questions')
                ->onUpdate('restrict')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('answers', function (Blueprint $table) {
            $table->dropForeign('answers_fk_question_id_2');

            $table->foreign('question_id', 'answers_fk_question_id_1')
                ->references('id')
                ->on('questions');
        });
    }
}
