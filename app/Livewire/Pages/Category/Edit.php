<?php

namespace App\Livewire\Pages\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Title;
use Masmerise\Toaster\Toaster;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Access\AuthorizationException;

class Edit extends Component
{
  #[Layout('layouts.app')]
  #[Title('Edit Kategori')]

  public Category $category;

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

  public function mount(Category $category)
  {
    $this->category = $category;
    $this->name = $category->nama;
    $this->description = $category->keterangan;
  }

  public function update()
  {
    try {
      $this->authorize('update', Category::class);
      DB::beginTransaction();
      $this->validate([
        'name' => ['required', 'string', 'max:255'],
        'description' => ['required', 'string', 'max:255'],
      ]);
      $this->category->update([
        'nama' => $this->name,
        'keterangan' => $this->description
      ]);
      DB::commit();
      return redirect()->route('categories.index')->success('Kategori berhasil diubah');
    } catch (AuthorizationException $e) {
      Toaster::warning('Anda tidak memiliki akses untuk mengubah kategori');
    } catch (\Exception $e) {
      DB::rollBack();
      Toaster::error('Gagal mengubah kategori');
    }
  }
  public function render()
  {
    return view('livewire.pages.category.edit');
  }
}
