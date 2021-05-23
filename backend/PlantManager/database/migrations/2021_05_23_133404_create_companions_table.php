<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('species_id');
            $table->foreignId('companion_id');
            $table->tinyInteger('type');
            $table->text('description');
            $table->timestamps();

            $table->foreign('species_id')
                ->references('id')
                ->on('species')
                ->onDelete('cascade');

                $table->foreign('companion_id')
                ->references('id')
                ->on('species')
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
        Schema::dropIfExists('companions');
    }
}
