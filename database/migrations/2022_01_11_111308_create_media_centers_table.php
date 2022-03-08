<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_centers', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('description');
            $table->text('body')->nullable();
            $table->string('image')->nullable();
            $table->string('youtube')->nullable();
            $table->string('video')->nullable();
            $table->boolean('in_home')->default(false);
            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('media_centers');
    }
}
