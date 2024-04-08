<?php

// database/migrations/yyyy_mm_dd_hhmmss_create_notifications_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // Loại thông báo
            $table->text('message'); // Nội dung thông báo
            $table->boolean('read')->default(false); // Trạng thái đã đọc hay chưa
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
