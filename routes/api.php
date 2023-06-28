<?php


use App\Models\User;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontPageController;
use App\Http\Controllers\AdminProvinceController;
use App\Http\Controllers\AdminRegionController;
use App\Http\Controllers\PersonalReportController;
use App\Http\Controllers\WaterbodyController;
use App\Http\Controllers\WaterbodyPersonalReportController;
use App\Http\Controllers\WaterbodyWeeklyReportController;
use League\CommonMark\Extension\FrontMatter\FrontMatterParser;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:sanctum')->get('user', function (Request $request) {
    return $request->user();  
});

Route::middleware(['auth:sanctum'])->group(function () {
    
    Route::get('/personal_reports', [PersonalReportController::class, 'index']);
    Route::get('/unapproved_personal_reports', [PersonalReportController::class, 'getUnapprovedReports']);
    Route::put('/personal_reports/{id}', [PersonalReportController::class, 'update']);
    Route::delete('/personal_reports/{id}', [PersonalReportController::class, 'destroy']);

    Route::get('/admin/provinces', [AdminProvinceController::class, 'index']);
    Route::get('/admin/provinces/{id}', [AdminProvinceController::class, 'show']);
    Route::put('/provinces/{id}', [AdminProvinceController::class, 'update']);
    Route::get('/admin/provinces_report/{id}', [AdminProvinceController::class, 'getAdminProvinceReportData']);
    Route::get('/admin/unapproved_data', [AdminProvinceController::class, 'getProvincesUnapprovedData']);


    Route::get('/regions', [AdminRegionController::class, 'index']);
    Route::post('/provinces/{id}/regions', [AdminRegionController::class, 'create']);
    Route::put('/regions/{region_id}', [AdminRegionController::class, 'update']);
    Route::delete('/regions/{region_id}', [AdminRegionController::class, 'destroy']);

    Route::get('/admin/provinces/{id}/waterbodies', [WaterbodyController::class, 'getWaterbodiesByProvince']);
    Route::post('/admin/provinces/{id}/waterbodies', [WaterbodyController::class, 'storeProvinceWaterbody']);
    Route::put('/admin/waterbodies/{id}', [WaterbodyController::class, 'updateProvinceWaterbody']);
    Route::delete('/waterbodies/{id}', [WaterbodyController::class, 'destroy']);
    Route::get('/admin/waterbodies_unlisted/', [WaterbodyController::class, 'getUnlistedWaterbodies']);

    Route::post('/admin/waterbodies/{id}/reports', [WaterbodyWeeklyReportController::class, 'storeWaterbodyWeeklyReport']);
    Route::put('/report/{id}', [WaterbodyWeeklyReportController::class, 'updateWaterbodyWeeklyReport']);
    Route::delete('/report/{id}', [WaterbodyWeeklyReportController::class, 'deleteWaterbodyWeeklyReport']);
});

Route::post('/sanctum/token', function (Request $request) {

    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $user->createToken($user->email)->plainTextToken;
});

Route::get('provinces', [FrontPageController::class, 'getProvinces']);
Route::get('provinces/{id}', [FrontPageController::class, 'getProvinceReportData']);
Route::get('waterbodies_default', [FrontPageController::class, 'getDefaultWaterbodies']);
Route::get('active_waterbodies', [FrontPageController::class, 'getActiveWaterbodies']);
Route::get('waterbodies', [FrontPageController::class, 'getWaterbodies']);
Route::get('location_waterbodies/{lat}/{lng}', [FrontPageController::class, 'getWaterbodiesByLocation']);

Route::get('waterbodies/{id}', [WaterbodyController::class, 'showWaterbodyReport']);

Route::post('waterbodies/{waterbody}/personal_reports', [WaterbodyPersonalReportController::class, 'store']);

Route::post('waterbodies', [WaterbodyController::class, 'storeUnlistedWaterbody']);