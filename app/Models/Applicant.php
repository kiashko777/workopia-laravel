<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_id',
        'full_name',
        'contact_email',
        'contact_phone',
        'resume_path',
        'message',
        'location',
    ];

    //Relation to User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //Relation to Job
    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }
}
