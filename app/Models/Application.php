<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'program_id',
        'father_name',
        'father_cnic',
        'father_occupation',
        'date_of_birth',
        'gender',
        'domicile',
        'matric_board',
        'matric_roll_no',
        'matric_total_marks',
        'matric_obtained_marks',
        'matric_percentage',
        'matric_passing_year',
        'inter_board',
        'inter_roll_no',
        'inter_total_marks',
        'inter_obtained_marks',
        'inter_percentage',
        'inter_passing_year',
        'status',
        'admin_comments',
        'submitted_at',
        'reviewed_at',
        'reviewed_by',

        // ✅ CHALLAN
        'challan_number',
        'challan_pdf',
        'challan_paid_copy',
        'challan_status',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'submitted_at'  => 'datetime',
        'reviewed_at'   => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
