<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentProfile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'full_name',
        'nik',
        'birth_place',
        'birth_date',
        'address',
        'about_me',
        'profile_completion_percentage',
        'is_personal_complete',
        'is_academic_complete',
        'is_family_complete',
        'is_documents_complete'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'is_personal_complete' => 'boolean',
        'is_academic_complete' => 'boolean',
        'is_family_complete' => 'boolean',
        'is_documents_complete' => 'boolean',
        'profile_completion_percentage' => 'integer'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function educations(): HasMany
    {
        return $this->hasMany(StudentEducation::class);
    }

    public function experiences(): HasMany
    {
        return $this->hasMany(StudentExperience::class);
    }

    public function certifications(): HasMany
    {
        return $this->hasMany(StudentCertification::class);
    }

    public function awards(): HasMany
    {
        return $this->hasMany(StudentAward::class);
    }

    public function skills(): HasMany
    {
        return $this->hasMany(StudentSkill::class);
    }

    public function familyMembers(): HasMany
    {
        return $this->hasMany(StudentFamilyMember::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(StudentDocument::class);
    }

    public function calculateCompletionPercentage(): void
    {
        $totalSections = 4; // Personal, Academic, Family, Documents
        $completedSections = 0;

        // Check personal information completion
        $this->is_personal_complete = !empty($this->full_name) && 
                                    !empty($this->nik) && 
                                    !empty($this->birth_place) && 
                                    !empty($this->birth_date) && 
                                    !empty($this->address);
        if ($this->is_personal_complete) {
            $completedSections++;
        }

        // Check academic information completion
        $this->is_academic_complete = $this->educations()->exists() && 
                                    $this->experiences()->exists() && 
                                    $this->certifications()->exists() && 
                                    $this->awards()->exists() && 
                                    $this->skills()->exists();
        if ($this->is_academic_complete) {
            $completedSections++;
        }

        // Check family information completion
        $this->is_family_complete = $this->familyMembers()->exists();
        if ($this->is_family_complete) {
            $completedSections++;
        }

        // Check documents completion
        $this->is_documents_complete = $this->documents()->exists();
        if ($this->is_documents_complete) {
            $completedSections++;
        }

        // Calculate percentage
        $this->profile_completion_percentage = ($completedSections / $totalSections) * 100;
        
        // Save the changes
        $this->save();
    }

    public function isProfileComplete(): bool
    {
        return $this->profile_completion_percentage === 100;
    }
} 