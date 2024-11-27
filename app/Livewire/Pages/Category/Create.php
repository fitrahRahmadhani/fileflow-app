<?php

namespace App\Livewire\Pages\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Title;
use Masmerise\Toaster\Toaster;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;

class Create extends Component
{
  #[Layout('layouts.app')]
  #[Title('Buat Kategori')]

  public $user;

  #[Validate('required', message: 'Input field nama kategori tidak boleh kosong')]
  #[Validate('min:3', message: 'Input field nama kategori tidak boleh kurang dari 3 karakter')]
  #[Validate('max:100', message: 'Input field nama kategori tidak boleh lebih dari 100 karakter')]
  #[Validate('regex:/^[a-zA-Z1-9\s]+$/', message: 'Input field nama kategori hanya boleh mengandung huruf, angka, dan spasi')]
  public $name;

  #[Validate('required', message: 'Input field deskripsi kategori tidak boleh kosong')]
  #[Validate('min:10', message: 'Input field deskripsi kategori tidak boleh kurang dari 10 karakter')]
  #[Validate('max:200', message: 'Input field deskripsi kategori tidak boleh lebih dari 200 karakter')]
  #[Validate('regex:/^[a-zA-Z1-9\s,.]+$/', message: 'Input field deskripsi kategori hanya boleh mengandung huruf, angka, dan spasi')]
  public $description;

  public function mount()
  {
    $this->user = Auth::user();
  }

  public function store()
  {
    try {
      DB::beginTransaction();
      $this->authorize('create', Category::class);
      $this->validate([
        'name' => ['required', 'string', 'max:255'],
        'description' => ['required', 'string', 'max:255'],
      ]);
      Category::create([
        'nama' => $this->name,
        'keterangan' => $this->description
      ]);
      DB::commit();
      return redirect()->route('categories.index')->success('Kategori baru berhasil dibuat');
    } catch (AuthorizationException $e) {
      DB::rollBack();
      Toaster::error('Anda tidak memiliki akses untuk membuat kategori');
    } catch (\Exception $e) {
      DB::rollBack();
      Toaster::error('Gagal membuat kategori');
    }
  }
  public function render()
  {
    return view('livewire.pages.category.create');
  }
}
