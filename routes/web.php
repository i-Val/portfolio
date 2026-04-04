<?php

use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SiteSettingsController;
use App\Http\Controllers\BlogInteractionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/portfolio', [HomeController::class, 'portfolio'])->name('portfolio');
Route::get('/portfolio/{slug}', [HomeController::class, 'singleProject'])->name('portfolio.show');
Route::get('/blogs', [HomeController::class, 'blogs'])->name('blogs');
Route::get('/single-blog/{id}', [HomeController::class, 'singleBlog'])->name('single-blog');
Route::post('/blogs/{blogPost}/like', [BlogInteractionController::class, 'toggleLike'])->name('blogs.like');
Route::post('/blogs/{blogPost}/share', [BlogInteractionController::class, 'share'])->name('blogs.share');
Route::post('/blogs/{blogPost}/comment', [BlogInteractionController::class, 'comment'])->name('blogs.comment');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'submitContact'])->name('contact.submit');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::redirect('/', '/dashboard');
        Route::resource('blog-posts', BlogPostController::class)->except(['show']);
        Route::resource('projects', ProjectController::class)->except(['show']);
        Route::resource('services', ServiceController::class)->except(['show']);
        Route::resource('contact-messages', ContactMessageController::class)->only(['index', 'show', 'destroy']);
        Route::patch('contact-messages/{contactMessage}/mark', [ContactMessageController::class, 'mark'])->name('contact-messages.mark');
        Route::get('site-settings', [\App\Http\Controllers\Admin\SiteSettingsController::class, 'edit'])->name('site-settings.edit');
        Route::put('site-settings', [\App\Http\Controllers\Admin\SiteSettingsController::class, 'update'])->name('site-settings.update');

        Route::get('content', [\App\Http\Controllers\Admin\ContentController::class, 'edit'])->name('content.edit');
        Route::put('content', [\App\Http\Controllers\Admin\ContentController::class, 'update'])->name('content.update');

        Route::get('profile', [\App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [AdminProfileController::class, 'update'])->name('profile.update');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
