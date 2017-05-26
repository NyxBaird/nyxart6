<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAndPopulateMusicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('music', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('cover');
            $table->string('youtube');
            $table->date('release_date');
            $table->timestamps();
            $table->softDeletes();
        });

        \DB::table('music')->insert([
            [
                'slug' => "eclipse",
                "title" => "Eclipse",
                "youtube" => "bjqdmFRaFeg",
                "cover" => "eclipsed.jpg",
                "release_date" => "2013-09-07",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ],
            [
                'slug' => "synthasia_i",
                "title" => "Synthasia I",
                "youtube" => "o9dZoSJnTk8",
                "cover" => "synthasia1.jpg",
                "release_date" => "2013-12-20",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ],
            [
                'slug' => "synthasia_ii",
                "title" => "Synthasia II",
                "youtube" => "-lwkSRrRQMM",
                "cover" => "synthasia2.jpg",
                "release_date" => "2014-04-20",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ],
            [
                'slug' => "nyxcerto",
                "title" => "Nyxcerto",
                "youtube" => "-SqM8o9GAYgo",
                "cover" => "nyxcerto.jpg",
                "release_date" => "2014-04-23",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ],
            [
                'slug' => "star_lite_star_brite_-_instrumental",
                "title" => "Star Lite, Star Brite - Instrumental",
                "youtube" => "re-RxLXNSIU",
                "cover" => "starliteinstrumental.jpg",
                "release_date" => "2014-04-23",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ],
            [
                'slug' => "star_lite_star_brite_-_vocaloid",
                "title" => "Star Lite, Star Brite - Vocaloid",
                "youtube" => "834lnBlg9Gs",
                "cover" => "starlitevocaloid.jpg",
                "release_date" => "2014-06-14",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ],
            [
                'slug' => "sunsets",
                "title" => "Sunsets",
                "youtube" => "w8qBBOXy1pE",
                "cover" => "sunsets.jpg",
                "release_date" => "2013-12-27",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ],
            [
                'slug' => "birds_of_the_feather_-_instrumental",
                "title" => "Birds of The Feather - Instrumental",
                "youtube" => "hobcp-h6Kfs",
                "cover" => "botf.jpg",
                "release_date" => "2014-07-16",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ],
            [
                'slug' => "shooting_star_-_instrumental",
                "title" => "Shooting Star - Instrumental",
                "youtube" => "re-RxLXNSIU",
                "cover" => "shootingStar.jpg",
                "release_date" => "2014-11-15",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ],
            [
                'slug' => "infinity_theme",
                "title" => "Infinity Theme",
                "youtube" => "WdZqcSi0Ic8",
                "cover" => "InfinityTheme.jpg",
                "release_date" => "2015-11-03",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ],
            [
                'slug' => "the_timelord_victorius",
                "title" => "The Timelord Victorius",
                "youtube" => "rff9xbU3-5w",
                "cover" => "",
                "release_date" => "2016-02-18",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ],
            [
                'slug' => "is_anybody_out_there",
                "title" => "Is Anybody Out There",
                "youtube" => "Ass0_vp8ZBE",
                "cover" => "",
                "release_date" => "2016-05-01",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ],
            [
                'slug' => "infinity_theme_mastered",
                "title" => "Infinity Theme [Mastered]",
                "youtube" => "H0PUiWF89_8",
                "cover" => "",
                "release_date" => "2016-08-13",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
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
        Schema::drop('music');
    }
}
