<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnSettingForWebsiteFortend extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->text('icon')->nullable();
            $table->text('logo')->nullable();
            $table->text('title')->nullable();
            $table->text('slogan')->nullable();
            $table->text('text_footer')->nullable();
            $table->text('email')->nullable();
            $table->text('phone')->nullable();
            $table->text('address')->nullable();
            $table->text('open_time')->nullable();
            $table->text('support_time')->nullable();
            $table->text('ifram_map')->nullable();
            $table->text('link_facebook')->nullable();
            $table->text('link_youtube')->nullable();
            $table->text('link_twitter')->nullable();
            $table->text('link_linkedin')->nullable();
            $table->text('link_pinterest')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['icon',
                            'logo',
                            'title',
                            'slogan',
                            'text_footer',
                            'email',
                            'phone',
                            'address',
                            'open_time',
                            'support_time',
                            'ifram_map',
                            'link_facebook',
                            'link_youtube',
                            'link_twitter',
                            'link_linkedin',
                            'link_pinterest']);
        });
    }
}
