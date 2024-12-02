<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();                                      // LogID, auto-increment
            $table->timestamp('event_time')->useCurrent();     // EventTime with current timestamp
            $table->unsignedBigInteger('user_id')->nullable(); // UserID, nullable for optional association
            $table->string('ip_address', 45)->nullable();      // IPAddress, supports both IPv4 and IPv6
            $table->text('message');                           // Message, description of the event
            $table->string('event_severity');
            $table->timestamps();                              // Timestamps for created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('logs');
    }
}

