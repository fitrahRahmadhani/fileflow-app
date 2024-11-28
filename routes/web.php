<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;

require __DIR__ . '/auth.php';

Route::get('documents', App\Livewire\Pages\Document\Index::class)
    ->middleware(['auth', 'verified'])
    ->name('documents.index');
Route::get('documents/create', App\Livewire\Pages\Document\Create::class)
    ->middleware(['auth', 'verified'])
    ->name('documents.create');
Route::get('documents/show/{document:slug}', App\Livewire\Pages\Document\Show::class)
    ->middleware(['auth', 'verified'])
    ->name('documents.show');
Route::get('documents/{document:slug}/edit', App\Livewire\Pages\Document\Edit::class)
    ->middleware(['auth', 'verified'])
    ->name('documents.edit');

Route::get('categories', App\Livewire\Pages\Category\Index::class)
    ->middleware(['auth', 'verified'])
    ->name('categories.index');
Route::get('categories/create', App\Livewire\Pages\Category\Create::class)
    ->middleware(['auth', 'verified'])
    ->name('categories.create');
Route::get('categories/{category:slug}/edit', App\Livewire\Pages\Category\Edit::class)
    ->middleware(['auth', 'verified'])
    ->name('categories.edit');

Route::get('profile', App\Livewire\Pages\Profile\Index::class)
    ->middleware(['auth', 'verified'])
    ->name('profile.index');
Route::get('profile/{user}/edit', App\Livewire\Pages\Profile\Index::class)
    ->middleware(['auth', 'verified'])
    ->name('profile.edit');
