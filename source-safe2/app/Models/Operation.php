<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{

    protected $fillable = [
        'user_id',
        'file_id',
        'type'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function file()
    {
        return $this->belongsTo(File::class);
    }
}
