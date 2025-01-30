<?php

use App\Livewire\Home;
use App\Livewire\Reels;
use App\Livewire\Explore;
use App\Livewire\Profile\Saved;
use App\Livewire\Post\View\Modal;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Livewire\Chat\Index;
use App\Livewire\Chat\Main;
use App\Livewire\Post\View\Page;
use App\Livewire\Profile\Home as ProfileHome;
use App\Livewire\Profile\Reels as ProfileReels;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/', Home::class)->name('home');

    Route::get('/chats', Index::class)->name('chats');
    Route::get('/chats/{chat}', Main::class)->name('chats.main');

    Route::get('/explore', Explore::class)->name('explore');

    Route::get('/post/{post}', Page::class)->name('post.view');
    Route::get('/post/{post}/modal', Modal::class)->name('post.view-modal');
    Route::get('/reels', Reels::class)->name('reels');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/profile/{user}', ProfileHome::class)->name('profile.home');
    Route::get('/profile/{user}/reels', ProfileReels::class)->name('profile.reels');
    Route::get('/profile/{user}/saved', Saved::class)->name('profile.saved');
});

require __DIR__.'/auth.php';
