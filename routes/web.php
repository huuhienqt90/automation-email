<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::resource('companies', CompanyController::class);
Route::resource('contacts', ContactController::class);
Route::get('campaigns/{campaign}/dashboard', [CampaignController::class, 'getDashboard'])
    ->name('campaigns.dashboard');
Route::get('campaigns/{campaign}/templates', [CampaignController::class, 'getTemplates'])
    ->name('campaigns.templates');
Route::get('campaigns/{campaign}/schedules', [CampaignController::class, 'getSchedules'])
    ->name('campaigns.schedules');
Route::get('campaigns/{campaign}/settings', [CampaignController::class, 'getSettings'])
    ->name('campaigns.settings');
Route::resource('campaigns', CampaignController::class);
