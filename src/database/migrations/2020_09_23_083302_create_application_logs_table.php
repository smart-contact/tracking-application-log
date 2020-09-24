<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('actor_id')->nullable();
            $table->string('subject');
            $table->string('description');
            $table->text('log')->nullable();
            $table->text('changes')->nullable();
            $table->string("level");
            $table->string('user_agent')->nullable();
            $table->string('browser')->nullable();
            $table->string('browser_version')->nullable();
            $table->string('platform')->nullable();
            $table->string('platform_version')->nullable();
            $table->string('ip')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('application_logs');
    }
}
