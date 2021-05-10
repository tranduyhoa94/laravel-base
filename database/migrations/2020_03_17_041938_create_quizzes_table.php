<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedInteger('topic_id');
            $table->integer('range_time');
            $table->string('status', 10);
            $table->integer('createdable_id');
            $table->string('createdable_type');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('topic_id', 'topics_fk_quizzes_id_1')
                ->references('id')
                ->on('topics');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quizzes');
    }
}
