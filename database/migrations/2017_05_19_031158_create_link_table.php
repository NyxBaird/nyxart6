<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function(Blueprint $table){
            $table->increments('id');
            $table->string('url')->default('#');
            $table->string('title');
            $table->string('type');
            $table->timestamps();
            $table->softDeletes();
        });

        $links = [
            [
                'url' => '/',
                'title' => 'Home',
                'type' => 'main',
                'created_at' => date('Y-m-d H:i:s', strtotime('now')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('now'))
            ],
            [
                'url' => '/blog',
                'title' => 'Blog',
                'type' => 'main',
                'created_at' => date('Y-m-d H:i:s', strtotime('now')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('now'))
            ],
            [
                'url' => '/music',
                'title' => 'Music',
                'type' => 'main',
                'created_at' => date('Y-m-d H:i:s', strtotime('now')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('now'))
            ],
            [
                'url' => '/dev',
                'title' => 'Development',
                'type' => 'main',
                'created_at' => date('Y-m-d H:i:s', strtotime('now')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('now'))
            ],
            [
                'url' => '/about',
                'title' => 'About',
                'type' => 'main',
                'created_at' => date('Y-m-d H:i:s', strtotime('now')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('now'))
            ]
        ];

        \DB::table('links')->insert($links);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('links');
    }
}
