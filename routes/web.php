<?php

use App\Http\Controllers\DegreeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/maintenance', [PagesController::class, 'maintenance'])->name('maintenance');

Route::middleware('maintenance')->group(function () {
    Route::get('/', [UserController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UserController::class, 'login'])->name('login.submit');

    Route::middleware('auth.session')->group(function () {
        Route::get('/change-password', [UserController::class, 'showChangePasswordForm'])->name('password.change.form');
        Route::post('/change-password', [UserController::class, 'updatePassword'])->name('password.change.update');
        Route::post('/logout', [UserController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

        Route::get('/student/dashboard', [UserController::class, 'studentDashboard'])
            ->middleware('role:student')
            ->name('student.dashboard');

        Route::get('/teacher/dashboard', [UserController::class, 'teacherDashboard'])
            ->middleware('role:teacher')
            ->name('teacher.dashboard');

        Route::get('/admin/dashboard', [UserController::class, 'adminDashboard'])
            ->middleware('role:admin')
            ->name('admin.dashboard');

        Route::middleware('role:admin')->group(function () {
            Route::resource('/students', StudentController::class);
            Route::resource('/teachers', TeacherController::class);
            Route::resource('/degree', DegreeController::class);
        });

        Route::get('/user_profile', [PagesController::class, 'userProfile']);
        Route::get('/user_post', [PagesController::class, 'userPost']);
        Route::get('/student_courses', [PagesController::class, 'studentCourses']);
    });
}
);
