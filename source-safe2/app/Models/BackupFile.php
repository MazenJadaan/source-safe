<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BackupFile extends Model
{

    protected $fillable = [
        'path',
        'file_id',
        'version',
        'updated_by'
    ];

    public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
