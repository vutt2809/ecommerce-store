<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('post_title_en');
            $table->string('post_title_vn');
            $table->string('post_slug_en');
            $table->string('post_slug_vn');
            $table->string('post_image');
            $table->string('post_details_en');
            $table->string('post_details_vn');
            $table->timestamps();
        });

        Schema::table('blog_posts', function (Blueprint $table) {
            $table->text('post_details_en')->change();
            $table->text('post_details_vn')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_posts');
    }
};
