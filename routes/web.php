<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FPPController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DraftController;
use App\Http\Controllers\ApprovalSOPController;
use App\Http\Controllers\MasterUsersTafisController;
use App\Http\Controllers\MasterSosialisasiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('loginv2');
});

// login
// Route::get('/login', [AuthController::class, 'login'])->name('loginPage');
// Route::post('/login-auth', [AuthController::class, 'authLogin']);

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});

Route::group(['middleware' => 'auth'], function () {
    // Auth
    Route::get('/home', [HomeController::class, 'index']);
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');

    // Master Users Tafis
    Route::get('/masterUsersTafis', [MasterUsersTafisController::class, 'index']);
    Route::post('/masterUsersTafis', [MasterUsersTafisController::class, 'masterUsersTafisStore'])->name('masterUsersTafisStore');
    Route::get('/masterUsersTafis/destroy/{id}', [MasterUsersTafisController::class, 'masterUsersTafisDestroy']);

    // Master Sosialisasi
    Route::get('/masterSosialisasi', [MasterSosialisasiController::class, 'index']);
    

    // Approval
    Route::get('/approval', [FPPController::class, 'index']);
    Route::post('/approval', [FPPController::class, 'approve'])->name('approve');

    // FPP SOP
    Route::get('/fppSop', [FPPController::class, 'index']);
    Route::post('/fppSop', [FPPController::class, 'fppSopStore'])->name('fppSopStore');
    Route::get('/fppSop/approve/{id}/{nik}/{isApprove}', [FPPController::class, 'fppSopApprove']);  
    Route::get('/fppSop/details/{id}', [FPPController::class, 'fppSopDetails']); 
    Route::get('/fppSop/export/{id}', [FPPController::class, 'fppSopExport']);
    Route::get('/fppSop/destroy/{id}', [FPPController::class, 'fppSopDestroy']);

    // Approval SOP
    Route::get('/approvalSop', [ApprovalSOPController::class, 'index']);
    Route::post('/approvalSop', [ApprovalSOPController::class, 'approvalSopStore'])->name('approvalSopStore');
    Route::get('/approvalSop/download/{id}', [ApprovalSOPController::class, 'approvalSopDownload']);
    Route::get('/approvalSop/details/{id}', [ApprovalSOPController::class, 'approvalSopDetails']);

});


// Test PDF
Route::get('/pdf', function() {
    return view('pdfViewTest.view-pdf');
});


// nomor form

Route::get('/fppSop/store', [FPPController::class, 'store']);

// pilih tukang approve
Route::get('/fppSop/fpp-approval', [FPPController::class, 'indexApproval'])->name('indexApprovalFppSop');
Route::post('/fpp-approval-input', [FPPController::class, 'indexApprovalStore']);

// approval SOP
Route::get('/approval-sop', [DraftController::class, 'index'])->name('indexDraft');
Route::get('/approve-rendy', [DraftController::class, 'approveRendy']);
Route::get('/approve-dede', [DraftController::class, 'approveDede']);
Route::get('/approve-mka', [DraftController::class, 'approveMKA']);
Route::get('/approve-kkarpa', [DraftController::class, 'approveKKARPA']);
Route::get('/approve-kia', [DraftController::class, 'approveKIA']);

Route::get('/test-compare', [DraftController::class, 'testCompare']);
