<?php

namespace App\Logging;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use Illuminate\Support\Facades\DB;
use Monolog\LogRecord;


class DatabaseLogHandler extends AbstractProcessingHandler
{
    /**
     * Write the log data to the database.
     *
     * @param array $record
     * @return void
     */
    protected function write(LogRecord $record): void
    {
        // تخزين السجل في قاعدة البيانات
        DB::table('logs')->insert([
            'event_time' => now(),                        // استخدام الوقت الحالي
            'user_id' => $record['context']['user_id'] ?? null, // استخدام user_id من الـ context، إن وجد
            'ip_address' => $record['extra']['ip_address'] ?? null, // استخدام عنوان الـ IP من extra
            'message' => $record['message'],              // الرسالة
            'event_severity' => $record['level_name'],    // شدة الحدث (INFO, WARNING, ERROR)
            'created_at' => now(),                        // الوقت الذي تم فيه إنشاء السجل
            'updated_at' => now(),                        // الوقت الذي تم فيه تحديث السجل
        ]);
    }

    /**
     * الحصول على المستوى الافتراضي للسجل.
     *
     * @return int
     */
    public function getDefaultLevel(): int
    {
        return Logger::DEBUG; // تحديد المستوى الافتراضي للسجل
    }
}
