<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\JobController as AdminJobController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\GuestUser;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\admin\JobsController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/job-post', [JobController::class, 'job_post'])->name('job.post_form');
Route::get('/job-list', [JobController::class, 'job_list'])->name('job.list');
Route::post('/job-post', [JobController::class, 'saveJob'])->name('job.post');
Route::get('/edit-job/{id}', [JobController::class, 'showEditJob'])->name('show.editjob');
Route::post('/edit-job', [JobController::class, 'editJob'])->name('edit.job');
Route::delete('/delete-job', [JobController::class, 'deleteJob'])->name('delete.job');
Route::get('/job-listing', [JobController::class, 'jobListing'])->name('job.listing');
Route::get('/job-detail/{id}', [JobController::class, 'job_detail'])->name('job.detail');
Route::post('/apply-job', [JobController::class, 'apply_job'])->name('apply.job');
Route::post('/saved-job', [JobController::class, 'savedJob'])->name('saved.job');
Route::get('/saved-jobs', [JobController::class, 'savedJobs'])->name('job.savedJobs');
Route::delete('/delete-savedjob', [JobController::class, 'deleteSavedJob'])->name('delete.savedjob');
Route::post('/send-message', [JobController::class, 'sendMessage'])->name('send.message');

Route::post('/upload-image', [AuthController::class, 'uploadImage'])->name('upload.image');
Route::post('/remove-application', [JobController::class, 'removeApplication'])->name('remove.application');

// Authenticated Routes
Route::middleware('auth')->group(function () {

Route::get('/user/profile', [AuthController::class, 'user_profile'])->name('user.profile');
Route::put('/update-profile', [AuthController::class, 'updateProfile'])->name('update.profile');
Route::post('/update-password', [AuthController::class, 'updatePassword'])->name('update.password');
Route::get('/my-applications', [JobController::class, 'my_applications'])->name('my.applications');
 Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Guest Routes
 Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'processLogin'])->name('auth.processLogin');
    Route::post('/register', [AuthController::class, 'processRegister'])->name('auth.processRegister');
    
// Admin Routes
Route::middleware('admin')->group(function () {

Route::get('/admin/dashboard', [AuthController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/user_list', [UserController::class, 'users'])->name('admin.user_list');
Route::get('/admin/edit_user/{id}', [UserController::class, 'show_edit_user'])->name('admin.show_edit_user');

Route::post('/admin/edit_user', [UserController::class, 'editUser'])->name('edit_user');
Route::delete('/admin/delete_user', [UserController::class, 'deleteUser'])->name('delete.user');
Route::get('/admin/jobs', [JobsController::class, 'all_jobs'])->name('admin.jobs');
Route::get('/admin/edit_job/{id}', [JobsController::class, 'show_edit_job'])->name('admin.show_edit_job');
Route::post('/admin/edit_job', [JobsController::class, 'editJob'])->name('admin.edit_job');
Route::post('/admin/delete_job', [JobsController::class, 'deleteJob'])->name('admin.delete_job');
Route::get('/admin/job_applications', [JobsController::class, 'show_job_applications'])->name('admin.job_applications');
Route::post('/admin/remove_application', [JobsController::class, 'removeApplication'])->name('admin.remove_application');
});