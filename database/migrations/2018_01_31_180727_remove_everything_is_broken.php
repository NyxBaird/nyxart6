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
		
		\DB::table('blog_posts')->insert([
			'title' => 'Another year, another goal',
			'body' => "Hi! It's 2018 now and I think that means it's officially been 3 years since my last blog post. Sorry about that- it's been a busy few years. I've spent most of it honing my web development and piano skills and developing a career path I can be proud of, but I also got married and finally found the chance to transition too so I'd say overall it's been a pretty positive stretch in my life. I'm excited to share with you all some upcoming music I have planned- including live performances of Chopin's Ballade 1 & Rachmaninoffs rendition of Kreislers \"Leibesleid\". I hope this year will be as productive as I believe it will be, but only time will tell... Keep posted for fantastically creative 2018.",
			'published_on' => '2018-01-31',
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s")
		]);
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
