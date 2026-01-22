<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'duration_years',
        'total_seats',
        'application_start_date',
        'application_end_date',
        'is_active'
    ];

    protected $casts = [
        'application_start_date' => 'date',
        'application_end_date' => 'date',
        'is_active' => 'boolean'
    ];

    // Relationships
    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}