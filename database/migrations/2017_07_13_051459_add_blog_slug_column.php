<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Domain\BlogPost;

class AddBlogSlugColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_posts', function(Blueprint $table){
            $table->string('slug')->after('title');
        });

        $posts = BlogPost::all();
        foreach($posts as $p){
            $p->slug = urlencode($p->title);
            $p->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_years', function(Blueprint $table){
            $table->dropColumn('slug');
        });
    }
}
