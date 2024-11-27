<?php

use Illuminate\Support\Facades\Route;



Route::get('arsip', App\Livewire\Pages\Document\Index::class)
    ->middleware(['auth', 'verified'])
    ->name('arsip');

Route::get('kategori', App\Livewire\Pages\Category\Index::class)
    ->middleware(['auth'])
    ->name('kategori');

Route::get('profil', App\Livewire\Pages\Profile\Index::class)
    ->middleware(['auth'])
    ->name('profil');

require __DIR__ . '/auth.php';
