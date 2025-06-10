<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\BukuTamuController;
use App\Http\Controllers\CrudManagementController;


Route::get('/', [BukuTamuController::class, 'showForm'])->name('home');
Route::post('/guest/store', [BukuTamuController::class, 'store'])->name('guest.store');
Route::get('/admin', [BukuTamuController::class, 'showAdmin'])->name('admin');


Route::get('/index', function () {
    return view('index');
})->name('index');


// ------------------------------------------------------------------------------------
// Route::get('/', [BukuTamuController::class, 'showForm'])->name('home');
// Route::post('/buku-tamu', [BukuTamuController::class, 'store'])->name('buku-tamu.store');
// Route::get('/admin', [BukuTamuController::class, 'index'])->name('admin.dashboard');
// Route::post('/buku-tamu', [BukuTamuController::class, 'store']);
// Route::put('/buku-tamu/{id}', [BukuTamuController::class, 'update']);
// Route::delete('/buku-tamu/{id}', [BukuTamuController::class, 'destroy']);
// ------------------------------------------------------------------------------------

// Route halaman utama
Route::get('/', function () {
    return view('index');
});

// Route halaman login
Route::get('/login', function () {
    return view('login');
})->name('login');

// Route proses login
Route::post('/login', function (Request $request) {
    if ($request->password === 'admin') {
        Session::put('is_admin', true);
        return redirect()->route('admin'); // ✅ nama route yang ada
    }
    return back()->with('error', 'Password salah');
});


// Route halaman dashboard admin
Route::get('/admin', function () {
    if (!Session::get('is_admin')) {
        return redirect()->route('login');
    }
    return view('admin');
})->name('admin'); // Ubah jadi 'admin'

// Route logout admin
Route::post('/logout', function () {
    Session::forget('is_admin');
    return redirect()->route('login');
})->name('logout');

Route::prefix('admin/crud')->name('crud.')->group(function () {
    Route::get('/', [CrudManagementController::class, 'index'])->name('index'); // Nama route: crud.index
});


// CRUD Management Routes (harus ada dalam group yang memerlukan auth admin)
Route::prefix('admin/crud')->name('crud.')->group(function () {
    
    // Dashboard CRUD
    Route::get('/', [CrudManagementController::class, 'index'])->name('index');
    
    // Events CRUD
    Route::prefix('events')->name('events.')->group(function () {
        Route::get('/', [CrudManagementController::class, 'eventsIndex'])->name('index');
        Route::get('/create', [CrudManagementController::class, 'eventsCreate'])->name('create');
        Route::post('/', [CrudManagementController::class, 'eventsStore'])->name('store');
        Route::get('/{event}/edit', [CrudManagementController::class, 'eventsEdit'])->name('edit');
        Route::put('/{event}', [CrudManagementController::class, 'eventsUpdate'])->name('update');
        Route::delete('/{event}', [CrudManagementController::class, 'eventsDestroy'])->name('destroy');
    });

    // Officials CRUD
    Route::prefix('officials')->name('officials.')->group(function () {
        Route::get('/', [CrudManagementController::class, 'officialsIndex'])->name('index');
        Route::get('/create', [CrudManagementController::class, 'officialsCreate'])->name('create');
        Route::post('/', [CrudManagementController::class, 'officialsStore'])->name('store');
        Route::get('/{official}/edit', [CrudManagementController::class, 'officialsEdit'])->name('edit');
        Route::put('/{official}', [CrudManagementController::class, 'officialsUpdate'])->name('update');
        Route::delete('/{official}', [CrudManagementController::class, 'officialsDestroy'])->name('destroy');
        Route::resource('crud/officials', OfficialController::class)->names('crud.officials');

    });

    // Departments CRUD
    Route::prefix('departments')->name('departments.')->group(function () {
        Route::get('/', [CrudManagementController::class, 'departmentsIndex'])->name('index');
        Route::get('/create', [CrudManagementController::class, 'departmentsCreate'])->name('create');
        Route::post('/', [CrudManagementController::class, 'departmentsStore'])->name('store');
        Route::get('/{department}/edit', [CrudManagementController::class, 'departmentsEdit'])->name('edit');
        Route::put('/{department}', [CrudManagementController::class, 'departmentsUpdate'])->name('update');
        Route::delete('/{department}', [CrudManagementController::class, 'departmentsDestroy'])->name('destroy');
    });

    // Guest Categories CRUD
    Route::prefix('guest-categories')->name('guest-categories.')->group(function () {
        Route::get('/', [CrudManagementController::class, 'guestCategoriesIndex'])->name('index');
        Route::get('/create', [CrudManagementController::class, 'guestCategoriesCreate'])->name('create');
        Route::post('/', [CrudManagementController::class, 'guestCategoriesStore'])->name('store');
        Route::get('/{guestCategory}/edit', [CrudManagementController::class, 'guestCategoriesEdit'])->name('edit');
        Route::put('/{guestCategory}', [CrudManagementController::class, 'guestCategoriesUpdate'])->name('update');
        Route::delete('/{guestCategory}', [CrudManagementController::class, 'guestCategoriesDestroy'])->name('destroy');
    });

    // Settings CRUD
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [CrudManagementController::class, 'settingsIndex'])->name('index');
        Route::get('/create', [CrudManagementController::class, 'settingsCreate'])->name('create');
        Route::post('/', [CrudManagementController::class, 'settingsStore'])->name('store');
        Route::get('/{setting}/edit', [CrudManagementController::class, 'settingsEdit'])->name('edit');
        Route::put('/{setting}', [CrudManagementController::class, 'settingsUpdate'])->name('update');
        Route::delete('/{setting}', [CrudManagementController::class, 'settingsDestroy'])->name('destroy');
    });
});
