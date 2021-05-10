<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteCloumnTopicIdTableQuestion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropForeign('topics_fk_questions_id_1');
            $table->dropColumn('topic_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('questions', function (Blueprint $table) {
//            $table->unsignedInteger('topic_id');
//            $table->foreign('topic_id', 'topics_fk_questions_id_1')
//                ->references('id')
//                ->on('topics');
//        });
    }
}
