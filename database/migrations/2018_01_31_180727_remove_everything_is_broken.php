<?php

use Domain\BlogPost;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveEverythingIsBroken extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //BlogPost::where('title', 'Everything is broken!')->delete();
		$music = BlogPost::where('title', 'Music to listen to')->first();
		$music->published_on = date("Y-m-d", strtotime('04/07/2015'));
		$music->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
