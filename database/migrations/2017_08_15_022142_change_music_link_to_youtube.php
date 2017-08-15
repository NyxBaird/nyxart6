<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeMusicLinkToYoutube extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $link = \App\Domain\Link::where('title', 'Music')->first();
        $link->url = "https://www.youtube.com/user/AdmiralCubie";
        $link->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $link = \App\Domain\Link::where('title', 'Music')->first();
        $link->url = "/music";
        $link->save();
    }
}
