<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dmo\DmoController;
use App\Http\Controllers\Dmo\BeneficiaryAuditController;
use App\Http\Controllers\Dmo\InfrastructureAuditController;
use App\Http\Controllers\RedirectController;

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

Route::get('/', [RedirectController::class, 'index'])->name('redirect.home');

Auth::routes();


Route::get('/admin_home', [HomeController::class, 'handleAdmin'])->name('admin.route')->middleware('admin');

Route::group(['prefix'=>'dmo','as'=>'dmo.', 'middleware' => 'is_dmo'], function(){
    Route::get('/home', [DmoController::class, 'home'])->name('home');
});

Route::group(['prefix'=>'audit','as'=>'audit.'], function(){
    Route::group(['prefix'=>'infrastructure','as'=>'infrastructure.'], function(){
        Route::get('/create', [InfrastructureAuditController::class, 'create'])->name('create');
        Route::post('/save', [InfrastructureAuditController::class, 'save'])->name('save');
        Route::get('/', [InfrastructureAuditController::class, 'viewAllAudits'])->name('index');
        Route::get('/{infra_audit_id}', [InfrastructureAuditController::class, 'viewAudit'])->name('view_audit');
    });

    Route::group(['prefix'=>'beneficiary','as'=>'beneficiary.'], function(){
        Route::get('/fetch-data', [BeneficiaryAuditController::class, 'fetchData'])->name('fetch_data');
        Route::post('/get-data', [BeneficiaryAuditController::class, 'getData'])->name('get_data');
        Route::get('/view-all-data', [BeneficiaryAuditController::class, 'viewAllData'])->name('view_all_data');
        
        Route::get('/view-all-home-visit', [BeneficiaryAuditController::class, 'viewAllHomeVisit'])->name('view_all_home_visits');
        Route::get('/view-home-visit/{id}', [BeneficiaryAuditController::class, 'viewHomeVisit'])->name('view_home_visit');
        Route::get('/home-visit/{id}', [BeneficiaryAuditController::class, 'homeVisit'])->name('home_visit');
        Route::post('/home-visit/{id}', [BeneficiaryAuditController::class, 'saveHomeVisit'])->name('save_home_visit');
        
        Route::get('/telephonic-audit/{id}', [BeneficiaryAuditController::class, 'telephonicAudit'])->name('telephonic_audit');
        Route::get('/details/{id}', [BeneficiaryAuditController::class, 'viewDetails'])->name('view_details');
        Route::post('/save/{id}', [BeneficiaryAuditController::class, 'saveTelephonicAudit'])->name('save_telephonic_audit');
        

        Route::get('/view-all-telephonic-audits', [BeneficiaryAuditController::class, 'viewAllTepephonicAudit'])->name('view_all_telephonic_audits');
        Route::get('/view-telephonic-audit/{id}', [BeneficiaryAuditController::class, 'viewTepephonicAudit'])->name('view_telephonic_audit');
        
    });

    Route::get('/infrastructure-audit-reports', [ReportsController::class, 'infraReport'])->name('infra.report');
    Route::get('/beneficiary-audit-reports', [ReportsController::class, 'beneficiaryReport'])->name('beneficiary.report');
});

Route::get('storage/{filename}', function ($filename)
{
    $path = storage_path('app/public/uploads/' . $filename);
    //dd($path);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
