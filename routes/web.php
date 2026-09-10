<?php

use App\Http\Controllers\AdminCmsPageController;
use App\Http\Controllers\AdminContactController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminAuditLogController;
use App\Http\Controllers\AdminTeamMemberController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DevAuthController;
use App\Http\Controllers\PublicCmsPageController;
use App\Http\Controllers\PublicContactController;
use App\Http\Controllers\PublicTeamController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicCmsPageController::class, 'show'])->defaults('slug', 'home')->name('home');

Route::get('/about', [PublicCmsPageController::class, 'show'])->defaults('slug', 'about')->name('about');
Route::get('/services', [PublicCmsPageController::class, 'show'])->defaults('slug', 'services')->name('services');
Route::view('/physical-therapy', 'pages.physical-therapy')->name('physical-therapy');
Route::get('/massage-therapy', [PublicCmsPageController::class, 'show'])->defaults('slug', 'massage')->name('massage-therapy');
Route::get('/team', PublicTeamController::class)->name('team');
Route::get('/new-patients', [PublicCmsPageController::class, 'show'])->defaults('slug', 'new-patients')->name('new-patients');
Route::get('/contact', PublicContactController::class)->name('contact');

Route::post('/contact', ContactController::class)
    ->middleware('throttle:10,1')
    ->name('contact.submit');

Route::middleware('guest.dev')->group(function (): void {
    Route::get('/devlogin', [DevAuthController::class, 'create'])->name('devlogin');
    Route::post('/devlogin', [DevAuthController::class, 'store'])->middleware('throttle:5,1')->name('devlogin.store');
    Route::get('/devlogin/forgot-password', [DevAuthController::class, 'forgot'])->name('devlogin.forgot');
    Route::post('/devlogin/forgot-password', [DevAuthController::class, 'sendResetHelp'])->middleware('throttle:3,1')->name('devlogin.forgot.send');
});

Route::post('/devlogout', [DevAuthController::class, 'destroy'])->name('devlogout');
Route::get('/admin/dashboard', AdminDashboardController::class)->name('admin.dashboard');
Route::get('/admindashboard', AdminDashboardController::class)->name('admin.dashboard.alias');
Route::get('/admin/contact-form', AdminContactController::class)->name('admin.contact');
Route::put('/admin/contact-form', [AdminContactController::class, 'update'])->name('admin.contact.update');
Route::get('/admin/pages/{slug}', [AdminCmsPageController::class, 'edit'])
    ->whereIn('slug', ['home', 'about', 'services', 'massage', 'new-patients'])
    ->name('admin.cms.edit');
Route::put('/admin/pages/{slug}', [AdminCmsPageController::class, 'update'])
    ->whereIn('slug', ['home', 'about', 'services', 'massage', 'new-patients'])
    ->name('admin.cms.update');
Route::get('/admin/team', [AdminTeamMemberController::class, 'index'])->name('admin.team');
Route::post('/admin/team', [AdminTeamMemberController::class, 'store'])->name('admin.team.store');
Route::put('/admin/team/{teamMember}', [AdminTeamMemberController::class, 'update'])->name('admin.team.update');
Route::delete('/admin/team/{teamMember}', [AdminTeamMemberController::class, 'destroy'])->name('admin.team.destroy');
Route::get('/admin/audit-log', AdminAuditLogController::class)->name('admin.audit');

// Preserve the original page addresses so old bookmarks and the existing links keep working.
Route::redirect('/index.html', '/');
Route::redirect('/about.html', '/about');
Route::redirect('/services.html', '/services');
Route::redirect('/physical-therapy.html', '/physical-therapy');
Route::redirect('/massage-therapy.html', '/massage-therapy');
Route::redirect('/team.html', '/team');
Route::redirect('/new-patients.html', '/new-patients');
Route::redirect('/contact.html', '/contact');

Route::redirect('/public_html/index.html', '/');
Route::redirect('/public_html/about.html', '/about');
Route::redirect('/public_html/services.html', '/services');
Route::redirect('/public_html/physical-therapy.html', '/physical-therapy');
Route::redirect('/public_html/massage-therapy.html', '/massage-therapy');
Route::redirect('/public_html/team.html', '/team');
Route::redirect('/public_html/new-patients.html', '/new-patients');
Route::redirect('/public_html/contact.html', '/contact');
