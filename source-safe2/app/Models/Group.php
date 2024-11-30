<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'name',
        'image'
    ];
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_group');
    }
    public function files()
    {
        return $this->hasMany(File::class);
    }
    public function admins()
    {
        return $this->belongsToMany(User::class, 'user_group')
            ->wherePivot('is_admin', true);
    }
    public function fileRequests()
    {
        return $this->hasMany(FileRequest::class,'group_id');
    }
}
