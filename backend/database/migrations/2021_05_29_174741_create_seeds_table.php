<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seeds', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->integer('number_of_seeds');
            $table->integer('amount');
            $table->foreignId('type_id')->constrained('plant_types');
            $table->foreignId('manufacturer_id')->constrained('manufacturers');
            $table->date('production_date');
            $table->date('expiration_date');
            $table->date('harvest_date');
            $table->text('notes')->nullable();
            $table->double('price');
            $table->integer('img_id');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();

//            $table->foreign('user_id')
//                ->references('id')
//                ->on('users')
//                ->onDelete('cascade');
//
//            $table->foreign('type_id')
//                ->references('id')
//                ->on('plant_types')
//                ->onDelete('cascade');
//
//            $table->foreign('manufacturer_id')
//                ->references('id')
//                ->on('manufacturers')
//                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seeds');
    }
}
