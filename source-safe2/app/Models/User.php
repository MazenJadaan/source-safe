<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;



class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
 protected $table = 'users';
    protected $fillable = [
        'name',
        'photo',
        'email',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class,'role_id');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'user_group');
    }
    public function adminGroups()
    {
        return $this->belongsToMany(Group::class, 'user_group')
            ->wherePivot('is_admin', true);
    }
    public function files()
    {
        return $this->hasMany(File::class, 'created_by');
    }

    public function backupFiles()
    {
        return $this->hasMany(BackupFile::class, 'updated_by');
    }

    public function operations()
    {
        return $this->hasMany(Operation::class);
    }
    public function fileRequests()
    {
        return $this->hasMany(FileRequest::class, 'uploaded_by');
    }


}
