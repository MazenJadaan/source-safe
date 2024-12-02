<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileRequest extends Model
{
    use HasFactory;

    // Table associated with the model
    protected $table = 'file_requests';

    // Mass assignable attributes
    protected $fillable = [
        'file_name',
        'file_path',
        'uploaded_by',
        'group_id',
        'status',
        'remarks',
    ];

    /**
     * Relationships
     */

    // User who uploaded the file
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    // Group to which the file belongs
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}

