<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentEducation extends Model
{
    use HasFactory;

    protected $table = 'student_education';

    protected $fillable = [
        'student_profile_id',
        'institution_name',
        'degree',
        'field_of_study',
        'start_date',
        'end_date',
        'is_current',
        'gpa',
        'description'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_current' => 'boolean'
    ];

    public function studentProfile(): BelongsTo
    {
        return $this->belongsTo(StudentProfile::class);
    }
} 