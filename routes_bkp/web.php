<?php
 
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

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController as UserController;
use App\Http\Controllers\Admin\PublicationsController;
use App\Http\Controllers\Admin\MediaContentController;
use App\Http\Controllers\Admin\NoticeBoardController;
use App\Http\Controllers\Admin\AgreementReportController;
use App\Http\Controllers\Admin\TaskReportController;

Route::get('/view-optimize', function() {
    Artisan::call('optimize:clear');
    return 'View cache has been cleared';
});
 

Route::middleware([])->group(function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'home')->name('home');
        Route::get('/media', 'media')->name('media');
        Route::get('/media-detail/{id}', 'mediaDetail')->name('mediaDetail');
        Route::get('/publications', 'publications')->name('publications');
        Route::get('/publication-detail/{id}', 'publicationDetail')->name('publicationDetail');
        Route::get('/changeLang', 'changeLang')->name('changeLang');
        Route::get('getLocations', 'getLocations')->name('getLocations');
        Route::post('getSearchResult', 'getSearchResult')->name('getSearchResult');
		
		Route::get('search', 'searchMediaPublication')->name('searchMediaPublication');
		
		Route::post('get-district', 'getDistrictListByStates')->name('getDistrictListByStates');
		Route::post('get-block', 'getBlockListByStates')->name('getBlockListByStates');
		
    });

    Route::controller(AuthController::class)->group(function () {
        Route::get('/admin', 'cgwbpnmlogin')->name('cgwbpnm');
        Route::get('/refresh_captcha', 'refreshCaptcha')->name('refresh_captcha');
        Route::post('/login', 'login')->name('admin.login');
    });
});
Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');
Route::group(['middleware' => ['XSS']] ,function() {     
    
    Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
	Route::group(['middleware' => ['auth:misadmin','prevent-back-history']], function() {
            
	Route::resource('roles', '\App\Http\Controllers\Admin\RoleController');
	Route::resource('permissions', '\App\Http\Controllers\Admin\PermissionController');
		
        Route::get('dashboard', [DashboardController::class,'dashboard'])->name('dashboard');
        Route::get('profile', [DashboardController::class,'profile'])->name('profile');
        Route::get('change-password', [DashboardController::class,'changePassword'])->name('changePassword');
        Route::post('change-password', [DashboardController::class,'changePasswordPost'])->name('changePasswordPost');	
    	
	Route::resource('admin', '\App\Http\Controllers\Admin\AdminController');
        Route::resource('supports', '\App\Http\Controllers\Admin\SupportController');  
        Route::resource('admin-agents', '\App\Http\Controllers\Admin\AdminAgentController'); 


        Route::resource('admin-agentreport', '\App\Http\Controllers\Admin\AgreementReportController');  
        Route::get('pendinglist',[AgreementReportController::class,'pendinglist'])->name('pendinglist'); 
        Route::get('approved',[AgreementReportController::class,'approved'])->name('approved'); 
        Route::get('reject',[AgreementReportController::class,'reject'])->name('reject'); 


        Route::get('completelist',[TaskReportController::class,'completelist'])->name('completelist'); 
        Route::get('notcompletelist',[TaskReportController::class,'notcompletelist'])->name('notcompletelist'); 
        Route::get('report',[TaskReportController::class,'report'])->name('report'); 
        
                
		//Route::resource('publications', '\App\Http\Controllers\Admin\PublicationsController');
		//Route::post('publications/storeMedia', [PublicationsController::class,'storeMedia'])->name('publications.storeMedia');
		
		//Route::resource('media-content', '\App\Http\Controllers\Admin\MediaContentController');
		//Route::post('media-content/storeMedia', [MediaContentController::class,'storeMedia'])->name('media-content.storeMedia');
		

		//Route::resource('notice-board', '\App\Http\Controllers\Admin\NoticeBoardController');
		//Route::post('notice-board/storeMedia', [NoticeBoardController::class,'storeMedia'])->name('notice-board.storeMedia');
		
		Route::resource('category', '\App\Http\Controllers\master\CategoryController');
		
		//Route::post('get-district', [PublicationsController::class,'getDistrictListByStates'])->name('publications.getDistrictListByStates');
		//Route::post('get-block', [PublicationsController::class,'getBlockListByStates'])->name('publications.getBlockListByStates');
	});	
});
});
