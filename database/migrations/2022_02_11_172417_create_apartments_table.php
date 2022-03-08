<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->text('description')->nullable();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image');
            $table->integer('n_rooms');
            $table->integer('n_bathroom');
            $table->integer('n_bed');
            $table->integer('square_meters');
            $table->decimal('latitude', 11, 8);
            $table->decimal('longitude', 11, 8);
            $table->boolean('visibility')->default(true);
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
        Schema::dropIfExists('apartments');
    }
}