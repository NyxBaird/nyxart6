<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpiritResponseTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spirit_response_types', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->integer('base_impact');
            $table->string('color');
            $table->timestamps();
            $table->softDeletes();
        });

        \DB::table('spirit_response_types')->insert([
            [
                'name' => 'conversational',
                'base_impact' => 1,
                'color' => '#fffa9b'
            ],
            [
                'name' => 'success',
                'base_impact' => 5,
                'color' => '#68c474'
            ],
            [
                'name' => 'neutral',
                'base_impact' => 0,
                'color' => '#ffffff'
            ],
            [
                'name' => 'error',
                'base_impact' => -10,
                'color' => '#ef4c4c'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('spirit_response_types');
    }
}
