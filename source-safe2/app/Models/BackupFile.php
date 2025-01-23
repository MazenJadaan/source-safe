<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BackupFile extends Model
{

    protected $fillable = [
        'path',
        'file_id',
        'version',
        'updated_by',
        'contentChanges',
        'hash'
    ];

    public function file()
    {
        return $this->belongsTo(File::class);
    }
    // تنسيق رقم النسخة
    public function getVersionNumberAttribute()
    {
        return 'v' . $this->version;
    }
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
