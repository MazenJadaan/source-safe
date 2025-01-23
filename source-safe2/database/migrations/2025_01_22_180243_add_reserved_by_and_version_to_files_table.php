<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReservedByAndVersionToFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('files', function (Blueprint $table) {
            $table->integer('reserved_by')->nullable()->after('status'); // العمود الخاص بالمستخدم الذي حجز الملف
            $table->foreign('reserved_by')->references('id')->on('users')->onDelete('set null'); // علاقة مع جدول المستخدمين
            $table->integer('version')->default(1)->after('reserved_by'); // العمود الخاص بالإصدار، يبدأ من 1
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('files', function (Blueprint $table) {
            $table->dropForeign(['reserved_by']); // حذف المفتاح الخارجي
            $table->dropColumn('reserved_by'); // حذف عمود الحجز
            $table->dropColumn('version'); // حذف عمود الإصدار
        });
    }
}
