<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateForeignTableQuestion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropForeign('quizzes_fk_questions_id_1');

            $table->foreign('quizz_id', 'quizzes_fk_questions_id_2')
                ->references('id')
                ->on('quizzes')
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
        Schema::table('questions', function (Blueprint $table) {
            $table->dropForeign('quizzes_fk_questions_id_2');

            $table->foreign('quizz_id', 'quizzes_fk_questions_id_1')
                ->references('id')
                ->on('quizzes');
        });
    }
}
