<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\SupervisorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    // User Management
    Route::resource('users', AdminController::class);
    Route::post('/users/{user}/activate', [AdminController::class, 'activate'])->name('users.activate');
    Route::post('/users/{user}/deactivate', [AdminController::class, 'deactivate'])->name('users.deactivate');
    
    // System Settings
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');
    
    // Reports & Analytics
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
    Route::get('/analytics', [AdminController::class, 'analytics'])->name('analytics');
});

// Lecturer Routes
Route::middleware(['auth', 'role:lecturer'])->prefix('lecturer')->name('lecturer.')->group(function () {
    Route::get('/dashboard', [LecturerController::class, 'index'])->name('dashboard');
    
    // Student Management
    Route::get('/students', [LecturerController::class, 'students'])->name('students');
    Route::get('/students/{student}', [LecturerController::class, 'showStudent'])->name('students.show');
    
    // Internship Management
    Route::resource('internships', LecturerController::class);
    Route::post('/internships/{internship}/approve', [LecturerController::class, 'approveInternship'])->name('internships.approve');
    Route::post('/internships/{internship}/reject', [LecturerController::class, 'rejectInternship'])->name('internships.reject');
    
    // Reports
    Route::get('/reports', [LecturerController::class, 'reports'])->name('reports');
    Route::get('/reports/generate', [LecturerController::class, 'generateReport'])->name('reports.generate');
});

// Company Routes
Route::middleware(['auth', 'role:company'])->prefix('company')->name('company.')->group(function () {
    Route::get('/dashboard', [CompanyController::class, 'index'])->name('dashboard');
    
    // Profile Management
    Route::get('/profile', [CompanyController::class, 'profile'])->name('profile');
    Route::put('/profile', [CompanyController::class, 'updateProfile'])->name('profile.update');
    
    // Internship Management
    Route::resource('internships', CompanyController::class);
    Route::get('/applications', [CompanyController::class, 'applications'])->name('applications');
    Route::post('/applications/{application}/approve', [CompanyController::class, 'approveApplication'])->name('applications.approve');
    Route::post('/applications/{application}/reject', [CompanyController::class, 'rejectApplication'])->name('applications.reject');
    
    // Reports
    Route::get('/reports', [CompanyController::class, 'reports'])->name('reports');
});

// Supervisor Routes
Route::middleware(['auth', 'role:supervisor'])->prefix('supervisor')->name('supervisor.')->group(function () {
    Route::get('/dashboard', [SupervisorController::class, 'index'])->name('dashboard');
    
    // Student Management
    Route::get('/students', [SupervisorController::class, 'students'])->name('students');
    Route::get('/students/{student}', [SupervisorController::class, 'showStudent'])->name('students.show');
    
    // Progress Reports
    Route::get('/reports', [SupervisorController::class, 'reports'])->name('reports');
    Route::post('/reports/{report}/approve', [SupervisorController::class, 'approveReport'])->name('reports.approve');
    Route::post('/reports/{report}/reject', [SupervisorController::class, 'rejectReport'])->name('reports.reject');
});

// Mahasiswa Routes
Route::middleware(['auth', 'mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile Routes
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [StudentProfileController::class, 'index'])->name('index');
        Route::post('/personal-info', [StudentProfileController::class, 'updatePersonalInfo'])->name('update-personal-info');
        
        // Add the edit route here
        Route::get('/{profile}/edit', [StudentProfileController::class, 'edit'])->name('edit');
        
        // Education routes
        Route::post('/education', [StudentProfileController::class, 'storeEducation'])->name('store-education');
        Route::put('/education/{id}', [StudentProfileController::class, 'updateEducation'])->name('update-education');
        Route::delete('/education/{id}', [StudentProfileController::class, 'deleteEducation'])->name('delete-education');
        
        // Experience routes
        Route::post('/experience', [StudentProfileController::class, 'storeExperience'])->name('store-experience');
        Route::put('/experience/{id}', [StudentProfileController::class, 'updateExperience'])->name('update-experience');
        Route::delete('/experience/{id}', [StudentProfileController::class, 'deleteExperience'])->name('delete-experience');
        
        // Certification routes
        Route::post('/certification', [StudentProfileController::class, 'storeCertification'])->name('store-certification');
        Route::put('/certification/{id}', [StudentProfileController::class, 'updateCertification'])->name('update-certification');
        Route::delete('/certification/{id}', [StudentProfileController::class, 'deleteCertification'])->name('delete-certification');
        
        // Award routes
        Route::post('/award', [StudentProfileController::class, 'storeAward'])->name('store-award');
        Route::put('/award/{id}', [StudentProfileController::class, 'updateAward'])->name('update-award');
        Route::delete('/award/{id}', [StudentProfileController::class, 'deleteAward'])->name('delete-award');
        
        // Skill routes
        Route::post('/skill', [StudentProfileController::class, 'storeSkill'])->name('store-skill');
        Route::put('/skill/{id}', [StudentProfileController::class, 'updateSkill'])->name('update-skill');
        Route::delete('/skill/{id}', [StudentProfileController::class, 'deleteSkill'])->name('delete-skill');
        
        // Family member routes
        Route::post('/family-member', [StudentProfileController::class, 'storeFamilyMember'])->name('store-family-member');
        Route::put('/family-member/{id}', [StudentProfileController::class, 'updateFamilyMember'])->name('update-family-member');
        Route::delete('/family-member/{id}', [StudentProfileController::class, 'deleteFamilyMember'])->name('delete-family-member');
        
        // Document routes
        Route::post('/document', [StudentProfileController::class, 'storeDocument'])->name('store-document');
        Route::put('/document/{id}', [StudentProfileController::class, 'updateDocument'])->name('update-document');
        Route::delete('/document/{id}', [StudentProfileController::class, 'deleteDocument'])->name('delete-document');
        Route::get('/document/{id}/download', [StudentProfileController::class, 'downloadDocument'])->name('download-document');
        
        // Profile completion status
        Route::get('/completion-status', [StudentProfileController::class, 'getProfileCompletionStatus'])->name('completion-status');
    });
    
    // Internship Routes
    Route::get('/internships', [InternshipController::class, 'index'])->name('internships.index');
    Route::get('/internships/{internship}', [InternshipController::class, 'show'])->name('internships.show');
    Route::post('/internships/{internship}/apply', [InternshipController::class, 'apply'])->name('internships.apply');
    Route::get('/applications', [InternshipController::class, 'applications'])->name('applications');
    
    // Report Routes
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/create', [ReportController::class, 'create'])->name('reports.create');
    Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');
    Route::get('/reports/{report}', [ReportController::class, 'show'])->name('reports.show');
    
    // Certificate Routes
    Route::get('/certificates', [CertificateController::class, 'index'])->name('certificates.index');
    Route::get('/certificates/{certificate}/download', [CertificateController::class, 'download'])->name('certificates.download');
});

// Redirect authenticated users to the appropriate dashboard
Route::get('/home', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 'mahasiswa') {
            return redirect()->route('mahasiswa.dashboard');
        }
        // Add other role redirects here if needed
    }
    return redirect('/');
})->name('home');