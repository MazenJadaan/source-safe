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
    'created_by',
    'updated_by'
];



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

    public function operations()
    {
        return $this->hasMany(Operation::class);
    }
}
