
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MoodController;
use App\Http\Controllers\EmotionController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PublicBlogController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\UserController;

use App\Models\Counselor;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Blog;

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\SessionNoteController;
use App\Http\Controllers\CounselorProfileController;
use App\Http\Controllers\CounselorAvailabilityController;
use App\Http\Controllers\PaymentController;

// Admin
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CounselorController;
use App\Http\Controllers\Admin\UserControllerAD;
use App\Http\Controllers\Admin\BlogController;

// Authentication Routes
Route::prefix('auth')->group(function() {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');

    Route::middleware('auth:web')->group(function () {
        Route::get('/user/dashboard', function() {
            return view('dashboard.user');
        })->name('user.dashboard');
    });

    Route::middleware('auth:counselor')->group(function () {
        Route::get('/counselor/dashboard', function() {
            return view('dashboard.counselor');
        })->name('counselor.dashboard');
    });

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

    // Password reset routes
    Route::get('forgot-password', [PasswordResetController::class, 'request'])->name('password.request');
    Route::post('forgot-password', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [PasswordResetController::class, 'reset'])->name('password.update');

});

// Profile Routes
Route::middleware('auth')->group(function() {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
});

// Authenticated Routes
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Home Route
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/counselors', function () {
    $counselors = Counselor::all();
    return view('layouts.counselors', compact('counselors'));
})->name('counselors');

// Navigation
Route::get('/blogs', [PublicBlogController::class, 'index'])->name('blogs');
Route::get('/blogs/{id}', [PublicBlogController::class, 'show'])->name('blogs.show');
// Route::get('/blogs', [PublicBlogController::class, 'index'])->name('blogs.index');
Route::get('/packages', [PageController::class, 'packages'])->name('packages');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

Route::view('/privacy', 'layouts.privacy')->name('privacy');

//  Emotion predict
Route::get('/emotion-predict', function () {
    return view('emotion_predict');
})->name('mood_predictor');

Route::post('/predict-emotion', [EmotionController::class, 'predictEmotion']);

Route::middleware('auth:web')->prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        $userCount = User::count();
        $counselorCount = Counselor::count();
        $appointmentCount = Appointment::count();
        $blogCount = Blog::count();

        return view('admin.dashboard', compact('userCount', 'counselorCount', 'appointmentCount', 'blogCount'));
    })->name('admin.dashboard');

    Route::get('/dashboard-data', [DashboardController::class, 'data'])->name('admin.dashboard-data');
    Route::get('/admin/dashboard/sales-data', [DashboardController::class, 'salesData']);

    // Manage users
    Route::get('/users', [UserControllerAD::class, 'index'])->name('users.index');
    Route::delete('/users/{user}', [UserControllerAD::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{user}/ban', [UserControllerAD::class, 'ban'])->name('users.ban');
    Route::post('/users/{user}/unban', [UserControllerAD::class, 'unban'])->name('users.unban');

    // Manage Counselor
    Route::resource('counselors', CounselorController::class)->names([
        'index'   => 'counselors.index',
        'create'  => 'admin.counselors.create',
        'store'   => 'admin.counselors.store',
        'edit'    => 'admin.counselors.edit',
        'update'  => 'admin.counselors.update',
        'destroy' => 'admin.counselors.destroy',
    ]);

    // Appointments
    Route::get('/appointments', [AppointmentController::class, 'adminIndex'])->name('admin.appointments.index');

    // Blog
    Route::resource('blogs', BlogController::class)->names([
        'index'   => 'admin.blogs.index',
        'create'  => 'admin.blogs.create',
        'store'   => 'admin.blogs.store',
        'show'    => 'admin.blogs.show',
        'edit'    => 'admin.blogs.edit',
        'update'  => 'admin.blogs.update',
        'destroy' => 'admin.blogs.destroy',
    ]);

    // Logout
    Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');
});

//end admin

// user
Route::middleware('auth:web')->prefix('user')->group(function () {
    Route::get('/dashboard', fn() => view('user.dashboard'))->name('user.dashboard');
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('user.profile.edit');
    Route::get('/mood-tracker', [MoodController::class, 'tracker'])->name('user.mood.tracker');
    // Route::get('/mood-history', [MoodController::class, 'history'])->name('user.mood.history');
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('user.appointments');
    Route::get('/packages', [PackageController::class, 'index'])->name('user.packages');
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('user.profile.edit');
    Route::post('/profile/update', [UserController::class, 'update'])->name('user.profile.update');
    Route::get('/mood-tracker', [MoodController::class, 'index'])->name('user.mood.index');
    Route::get('/mood-tracker', [MoodController::class, 'index'])->name('user.mood.index');
    Route::post('/mood-tracker', [MoodController::class, 'store'])->name('user.mood.store');
    Route::get('/appointments', [\App\Http\Controllers\AppointmentController::class, 'index'])->name('user.appointments.index');
});

Route::post('/appointments/{id}/cancel', [AppointmentController::class, 'userCancel'])->name('appointments.userCancel');

// end user

// counselor
Route::post('/counselor/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])
    ->middleware('auth:counselor')
    ->name('counselor.logout');

Route::middleware('auth:counselor')->prefix('counselor')->group(function () {
    Route::get('/dashboard', fn() => view('counselor.dashboard'))->name('counselor.dashboard');
    Route::get('/counselor/profile/edit', [CounselorProfileController::class, 'edit'])->name('counselor.profile.edit');
    Route::post('/counselor/profile/update', [CounselorProfileController::class, 'update'])->name('counselor.profile.update');

    Route::get('/counselor/appointments', [CounselorAppointmentController::class, 'index'])->name('counselor.appointments');
    Route::get('/counselor/clients', [CounselorClientController::class, 'index'])->name('counselor.clients');
    Route::get('/counselor/session-notes', [CounselorSessionNoteController::class, 'index'])->name('counselor.session-notes');
    Route::get('/counselor/availability', [CounselorAvailabilityController::class, 'index'])->name('counselor.availability');
    Route::post('/counselor/availability', [CounselorAvailabilityController::class, 'store'])->name('counselor.availability.store');

    Route::get('/appointments', [AppointmentController::class, 'counselorIndex'])->name('counselor.appointments.index');
    Route::post('/appointments/{id}/update-status', [AppointmentController::class, 'updateStatus'])->name('counselor.appointments.update');

    Route::get('/counselor/clients', [AppointmentController::class, 'viewClients'])->name('counselor.clients.index');

    Route::get('/session-notes', [SessionNoteController::class, 'index'])->name('counselor.session-notes');
    Route::get('/session-notes/create', [SessionNoteController::class, 'create'])->name('session-notes.create');
    Route::post('/session-notes', [SessionNoteController::class, 'store'])->name('session-notes.store');
    Route::get('/session-notes/{note}/edit', [SessionNoteController::class, 'edit'])->name('session-notes.edit');
    Route::put('/session-notes/{note}', [SessionNoteController::class, 'update'])->name('session-notes.update');
    Route::delete('/session-notes/{note}', [SessionNoteController::class, 'destroy'])->name('session-notes.destroy');
});

Route::middleware(['auth:counselor'])->prefix('counselor')->name('counselor.')->group(function () {
    Route::get('/profile/edit', [CounselorProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [CounselorProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/delete', [CounselorProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/counselor/view/{id}', function ($id) {
    $counselor = \App\Models\Counselor::findOrFail($id);
    return view('layouts.view-counselor', compact('counselor'));
})->name('counselor.view');

// Create Appointment (GET form page)
Route::get('/appointment/create/{counselor}', function ($counselorId) {
    if (!auth()->check()) {
        return redirect()->route('login');
    }
    $counselor = \App\Models\Counselor::findOrFail($counselorId);
    return view('layouts.make-appointment', compact('counselor'));
})->name('appointment.create');

// Make appointments
Route::middleware(['auth'])->group(function () {

    // Show form to create a new appointment with a counselor
    Route::get('/counselors/{counselor}/appointments/create', [AppointmentController::class, 'create'])
        ->name('appointments.create');

    // Store the newly created appointment
    Route::post('/counselors/{counselor}/appointments', [AppointmentController::class, 'store'])
        ->name('appointments.store');

    // View logged-in user's appointments
    Route::get('/my-appointments', [AppointmentController::class, 'index'])
        ->name('appointments.index');

    Route::get('/payment/{id}', [PaymentController::class, 'paymentPage'])->name('payments.page');


    Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
});

Route::middleware(['auth:counselor'])->group(function () {
    Route::get('/counselor/availability', [CounselorAvailabilityController::class, 'index'])->name('counselor.availability');

    Route::post('/counselor/availability', [CounselorAvailabilityController::class, 'store'])->name('counselor.availability.store');

    Route::get('/counselor/availability', [CounselorAvailabilityController::class, 'index'])->name('counselor.availability.index');

});
