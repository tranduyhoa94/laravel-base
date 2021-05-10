<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateForeignTableLimitTests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('limit_tests', function (Blueprint $table) {
            $table->dropForeign('limit_test_fk_subject_id_1');

            $table->foreign('subject_id', 'limit_test_fk_subject_id_2')
                ->references('id')
                ->on('subjects')
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
        Schema::table('limit_tests', function (Blueprint $table) {
            $table->dropForeign('limit_test_fk_subject_id_2');

            $table->foreign('subject_id', 'limit_test_fk_subject_id_1')
                ->references('id')
                ->on('subjects');
        });
    }
}
