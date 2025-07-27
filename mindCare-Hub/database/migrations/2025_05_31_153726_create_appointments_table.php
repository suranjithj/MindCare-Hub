<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('counselor_id');

            $table->string('user_name');
            $table->string('user_email');
            $table->string('mobile');

            $table->date('appointment_date');
            $table->time('appointment_time');

            $table->text('current_situation')->nullable();
            $table->text('reason')->nullable();

            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed', 'scheduled'])->default('pending');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('counselor_id')->references('id')->on('counselors')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
};
