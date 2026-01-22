<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challan extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'challan_number',
        'amount',
        'status',          // unpaid | paid | verified | rejected
        'issued_at',
        'paid_at',
        'verified_at',
        'remarks'
    ];

    protected $casts = [
        'issued_at'   => 'datetime',
        'paid_at'     => 'datetime',
        'verified_at' => 'datetime',
    ];

    /* ===============================
     * RELATIONSHIPS
     * =============================== */

    // Each challan belongs to one application
    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
