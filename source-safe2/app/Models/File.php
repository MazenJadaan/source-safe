<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
protected $fillable = [
    'name',
    'path',
    'status',
    'approval_status',
    'group_id',
    'reserved_by',
    'version',
    'created_by',
    'updated_by'
];
    public function isFree()
    {
        return $this->status === 'free';
    }


    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function backupFiles()
    {
        return $this->hasMany(BackupFile::class);
    }
    
  

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
   // أحدث نسخة
   public function getLatestVersionAttribute()
   {
       return $this->backupFiles()->latest()->first();
   }
    public function operations()
    {
        return $this->hasMany(Operation::class);
    }
}
