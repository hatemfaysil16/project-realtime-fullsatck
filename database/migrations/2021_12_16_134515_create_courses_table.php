<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->integer('lectures');
            $table->integer('duration');
            $table->integer('level');
            $table->string('language',2);
            $table->boolean('assessments');
            $table->text('description');
            $table->text('certification');
            $table->text('fullDescription');
            $table->boolean('active');
            $table->double('price');
            $table->foreignId('instructor_id')->references('id')->on('instructors')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('categories_id')->references('id')->on('categories')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('courses');
    }
}
