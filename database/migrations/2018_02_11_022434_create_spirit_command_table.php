<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpiritCommandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spirit_commands', function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('aliases')->default('');
            $table->string('parameters');
            $table->string('required_parameters');
            $table->string('description');
            $table->string('hook');
            $table->integer('level');
            $table->integer('impact_modifier');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('users', function (Blueprint $table){
            $table->integer('level')->default(0)->after('remember_token');
        });

        \DB::table('spirit_commands')->insert([
            [
                'name' => 'login',
                'parameters' => 'e|email,p|password',
                'required_parameters' => 'e|p',
                'description' => "This command lets verified users log in.",
                'hook' => 'AuthService@spiritLogin',
                'level' => 0,
                'impact_modifier' => 1
            ],
            [
                'name' => 'register',
                'parameters' => 'u|username,e|email,p|password',
                'required_parameters' => 'u|e|p',
                'description' => "This command lets guests register with a valid username and email",
                'hook' => 'AuthService@spiritRegister',
                'level' => 0,
                'impact_modifier' => 10
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
        Schema::drop('spirit_commands');
        Schema::table('users', function (Blueprint $table){
            $table->dropColumn('level');
        });
    }
}
