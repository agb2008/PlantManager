<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plants', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->foreignId('type_id')->constrained('plant_types');
            $table->foreignId('manufacturer_id')->constrained('manufacturers');
            $table->integer('amount');
            $table->integer('img_id');
            $table->text('notes');
            $table->double('price')->nullable();;
            $table->date('purchase_date');
            $table->date('plant_date');
            $table->foreignId('seeds_id')->nullable()->constrained('seeds');
            $table->foreignId('user_id')->constrained('users');
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
        Schema::dropIfExists('plants');
    }
}
