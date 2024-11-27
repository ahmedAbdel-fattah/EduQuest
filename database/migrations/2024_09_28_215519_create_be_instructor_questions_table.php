<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('be_instructor_questions', function (Blueprint $table) {
            $table->id();
            $table->text('question_title');
            $table->string('choice1');
            $table->string('choice2');
            $table->string('choice3');

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
        Schema::dropIfExists('be_instructor_questions');
    }
};
