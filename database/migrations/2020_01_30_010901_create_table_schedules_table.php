<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('topic_id');
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('teacher_id');
            $table->boolean('is_active')->default(1);
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('topic_id', 'schedules_fk_topic_id_1')
                ->references('id')
                ->on('topics')
                ->onUpdate('restrict')
                ->onDelete('cascade');
            $table->foreign('room_id', 'schedules_fk_room_id_1')
                ->references('id')
                ->on('rooms')
                ->onUpdate('restrict')
                ->onDelete('cascade');
            $table->foreign('teacher_id', 'schedules_fk_teacher_id_1')
                ->references('id')
                ->on('teachers')
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
        Schema::dropIfExists('schedules');
    }
}
