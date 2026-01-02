<?php


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Http\Controllers\AdminController;


// 1. Public Routes
Route::get('/', function () {
    return view('welcome');
});


Route::get('/admin/login', function () {
    return view('auth.admin-login');
})->name('admin.login');

// Admin login submission
use App\Http\Controllers\Auth\AdminAuthenticatedSessionController;
Route::post('/admin/login', [AdminAuthenticatedSessionController::class, 'store'])->name('admin.login.submit')->middleware('guest');


// 2. Protected Routes (Must be logged in)
Route::middleware(['auth', 'verified'])->group(function () {
   
    // Dashboard — fetch the authenticated user's next appointment and pass it to the view
    Route::get('/dashboard', function () {
        $user = Auth::user();
        $nextAppointment = null;

        if ($user) {
            $nextAppointment = Appointment::where('patient_id', $user->user_id)
                ->whereDate('date', '>=', now()->toDateString())
                ->whereIn('status', ['Approved', 'Pending'])
                ->with(['schedule.doctor.departments'])
                ->orderBy('date')
                ->first();
        }

        return view('dashboard', compact('nextAppointment'));
    })->name('dashboard');


    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // APPOINTMENTS (Consolidated into one place)
    // This single line creates: appointments.index, appointments.store, appointments.show, etc.
    Route::resource('appointments', AppointmentController::class);

    // Custom route for Cancel button (if you prefer this name over the default destroy)
    Route::delete('/appointments/cancel/{appointment}', [AppointmentController::class, 'destroy'])
        ->name('appointments.destroy');

    // Custom route for clearing completed records
    Route::post('/appointments/clear', [AppointmentController::class, 'clearRecords'])
        ->name('appointments.clear');


    // DEPARTMENTS
    Route::resource('department', DepartmentController::class);
    Route::get('/departments', [DepartmentController::class, 'index'])->name('department.index');
    Route::get('/departments/{department}', [DepartmentController::class, 'show'])->name('department.show');


    // Specific Department Doctor Lists
    Route::get('/department/cardiology/doctors', [DepartmentController::class, 'cardiology'])->name('department.cardiology');
    Route::get('/department/neurology/doctors', [DepartmentController::class, 'neurology'])->name('department.neurology');
    Route::get('/department/pediatrics/doctors', [DepartmentController::class, 'pediatrics'])->name('department.pediatrics');
    Route::get('/department/orthopedics/doctors', [DepartmentController::class, 'orthopedics'])->name('department.orthopedics');
    Route::get('/department/radiology/doctors', [DepartmentController::class, 'radiology'])->name('department.radiology');
    Route::get('/department/oncology/doctors', [DepartmentController::class, 'oncology'])->name('department.oncology');
    Route::get('/department/dermatology/doctors', [DepartmentController::class, 'dermatology'])->name('department.dermatology');
    Route::get('/department/psychiatry/doctors', [DepartmentController::class, 'psychiatry'])->name('department.psychiatry');
    Route::get('/department/general-surgery/doctors', [DepartmentController::class, 'generalSurgery'])->name('department.general-surgery');
    // Patient history route (shows appointments for the logged-in patient)
    Route::get('/patient-history', [AppointmentController::class, 'index'])->name('medical.history');
});

// Patient history routed to the AppointmentController (requires auth)

// Grouping admin routes for better organization
Route::prefix('admin')->middleware(['auth'])->group(function () {
    
    // This creates the link: yourdomain.com/admin/dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // You can add the other links here later
    // Route::get('/appointments', [AdminController::class, 'appointments'])->name('admin.appointments');
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // Add this new route for Managing Doctors
    Route::get('/doctors', [AdminController::class, 'manageDoctors'])->name('admin.doctors');
});

// Inside your Admin Middleware group — route through the controller so view gets data
Route::get('/admin/pending-requests', [App\Http\Controllers\AdminController::class, 'pendingRequests'])
    ->name('admin.pending');

// Find your admin route group and make sure it looks like this:
Route::middleware(['auth'])->group(function () {
    // ... your other routes

    // Point this specifically to your Admin controller
    Route::get('/admin/patient-records', [App\Http\Controllers\AdminController::class, 'records'])->name('admin.records');
    Route::post('/admin/patient-records/clear', [App\Http\Controllers\AdminController::class, 'clearRecords'])->name('admin.records.clear');
});

// (removed session-based status updater - AdminController will use DB-driven updates)

// The {index?} and {status?} make these parameters optional
Route::match(['get', 'post'], '/admin/pending-requests/{index?}/{status?}', 
    [AdminController::class, 'pendingRequests']
)->name('admin.pending-requests');

require __DIR__.'/auth.php';
