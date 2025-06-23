<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Models\StudentProfile;
use App\Models\StudentEducation;
use App\Models\StudentExperience;
use App\Models\StudentCertification;
use App\Models\StudentAward;
use App\Models\StudentSkill;
use App\Models\StudentFamilyMember;
use App\Models\StudentDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class StudentProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = StudentProfile::with([
            'educations', 
            'experiences', 
            'certifications', 
            'awards', 
            'skills', 
            'familyMembers', 
            'documents'
        ])->firstOrCreate(['user_id' => $user->id], [
            'full_name' => $user->name,
        ]);
        
        // Calculate profile completion percentage
        $profile->calculateCompletionPercentage();
        
        return view('mahasiswa.profile.index', compact('profile', 'user'));
    }

    public function edit(StudentProfile $profile)
    {
        // Load all relationships
        $profile->load([
            'educations',
            'experiences',
            'certifications',
            'awards',
            'skills',
            'familyMembers',
            'documents'
        ]);

        return view('mahasiswa.profile.edit', compact('profile'));
    }

    public function update(Request $request, StudentProfile $profile)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:student_profiles,nik,' . $profile->id,
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'address' => 'required|string',
            'about_me' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $profile->update($request->only([
                'full_name',
                'nik',
                'birth_place',
                'birth_date',
                'address',
                'about_me'
            ]));

            $profile->calculateCompletionPercentage();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Profil berhasil diperbarui',
                'profile' => $profile
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function uploadDocument(Request $request, StudentProfile $profile)
    {
        $validator = Validator::make($request->all(), [
            'document_type' => 'required|string|in:cv,transcript,id_card,additional',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            'description' => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $file = $request->file('file');
            $originalFilename = $file->getClientOriginalName();
            $mimeType = $file->getMimeType();
            $fileSize = $file->getSize();

            // Generate unique filename
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Store file
            $path = $file->storeAs('documents/' . $profile->id, $filename, 'public');

            // Create document record
            $document = $profile->documents()->create([
                'type' => $request->document_type,
                'original_filename' => $originalFilename,
                'file_path' => $path,
                'mime_type' => $mimeType,
                'file_size' => $fileSize,
                'description' => $request->description
            ]);

            $profile->calculateCompletionPercentage();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Dokumen berhasil diunggah',
                'document' => $document
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteDocument($id)
    {
        try {
            DB::beginTransaction();

            $profile = StudentProfile::where('user_id', Auth::id())->firstOrFail();
            $document = $profile->documents()->findOrFail($id);

            // Delete file from storage
            if (Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }

            // Delete document record
            $document->delete();

            $profile->calculateCompletionPercentage();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Dokumen berhasil dihapus'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function downloadDocument($id)
    {
        try {
            $profile = StudentProfile::where('user_id', Auth::id())->firstOrFail();
            $document = $profile->documents()->findOrFail($id);
            
            // Check if file exists in storage
            if (!Storage::disk('public')->exists($document->file_path)) {
                return response()->json([
                    'success' => false,
                    'message' => 'File tidak ditemukan'
                ], 404);
            }
            
            // Get the full path to the file
            $filePath = Storage::disk('public')->path($document->file_path);
            
            // Check if file is readable
            if (!is_readable($filePath)) {
                return response()->json([
                    'success' => false,
                    'message' => 'File tidak dapat diakses'
                ], 403);
            }
            
            // Set headers for file download
            $headers = [
                'Content-Type' => $document->mime_type,
                'Content-Disposition' => 'attachment; filename="' . $document->original_filename . '"',
                'Content-Length' => $document->file_size,
            ];
            
            // Return file download response
            return Response::download(
                $filePath,
                $document->original_filename,
                $headers
            );
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengunduh file: ' . $e->getMessage()
            ], 500);
        }
    }

    public function storeEducation(Request $request, StudentProfile $profile)
    {
        $validator = Validator::make($request->all(), [
            'institution_name' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'field_of_study' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_current' => 'boolean',
            'gpa' => 'nullable|numeric|min:0|max:4',
            'description' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $education = $profile->educations()->create([
                'institution_name' => $request->institution_name,
                'degree' => $request->degree,
                'field_of_study' => $request->field_of_study,
                'start_date' => $request->start_date,
                'end_date' => $request->is_current ? null : $request->end_date,
                'is_current' => $request->boolean('is_current'),
                'gpa' => $request->gpa,
                'description' => $request->description
            ]);

            $profile->calculateCompletionPercentage();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data pendidikan berhasil ditambahkan',
                'education' => $education
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateEducation(Request $request, StudentProfile $profile, $id)
    {
        $validator = Validator::make($request->all(), [
            'institution_name' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'field_of_study' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_current' => 'boolean',
            'gpa' => 'nullable|numeric|min:0|max:4',
            'description' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $education = $profile->educations()->findOrFail($id);
            $education->update([
                'institution_name' => $request->institution_name,
                'degree' => $request->degree,
                'field_of_study' => $request->field_of_study,
                'start_date' => $request->start_date,
                'end_date' => $request->boolean('is_current') ? null : $request->end_date,
                'is_current' => $request->boolean('is_current'),
                'gpa' => $request->gpa,
                'description' => $request->description
            ]);

            $profile->calculateCompletionPercentage();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data pendidikan berhasil diperbarui',
                'education' => $education
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteEducation(StudentProfile $profile, $id)
    {
        try {
            DB::beginTransaction();

            $education = $profile->educations()->findOrFail($id);
            $education->delete();

            $profile->calculateCompletionPercentage();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data pendidikan berhasil dihapus'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateFamilyMember(Request $request, StudentProfile $profile)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'relationship' => 'required|string|max:255',
            'occupation' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $familyMember = $profile->familyMembers()->create($request->all());
            $profile->calculateCompletionPercentage();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data anggota keluarga berhasil ditambahkan',
                'family_member' => $familyMember
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateSkill(Request $request, StudentProfile $profile)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'level' => 'required|string|in:beginner,intermediate,advanced,expert'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $skill = $profile->skills()->create($request->all());
            $profile->calculateCompletionPercentage();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Skill berhasil ditambahkan',
                'skill' => $skill
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
} 