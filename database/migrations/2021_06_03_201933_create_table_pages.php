<?php

use App\Models\pages as pageModels;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->integer('view')->default(0);
            $table->string('owner')->nullable();
            $table->longText('content')->nullable();
            $table->boolean('is_show')->default(true);
            $table->timestamps();
        });
        pageModels::addRow('Giới Thiệu Website', 'Admin', null);
        pageModels::addRow('Hướng Dẫn Sử Dụng', 'Admin', null);
        pageModels::addRow('Điều Khoản Dịch Vụ', 'Admin', null);
        pageModels::addRow('Chính Sách Bảo Mật', 'Admin', null);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_contents');
    }
}
