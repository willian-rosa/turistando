<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotoAttractionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo_attractions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->text('url');
            $table->uuid('attraction_id')->index();
            $table->foreign('attraction_id')->references('id')->on('attractions');
            $table->softDeletes();
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
        Schema::dropIfExists('photo_attractions');
    }
}
