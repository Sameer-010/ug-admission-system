<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'document_type',
        'file_name',
        'file_path',
        'file_size',
        'mime_type',
        'is_verified'
    ];

    protected $casts = [
        'is_verified' => 'boolean'
    ];

    // Relationships
    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}