<?php

namespace App\Livewire\Pages\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Masmerise\Toaster\Toaster;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;
use Livewire\WithoutUrlPagination;
use Illuminate\Auth\Access\AuthorizationException;

class Index extends Component
{
  use WithPagination, WithoutUrlPagination;

  #[Layout('layouts.app')]
  #[Title('Kategori')]

  public $search;

  #[On('destroy')]
  public function destroy($id)
  {
    try {
      $this->authorize('delete', Category::class);
      DB::beginTransaction();
      $category = Category::find($id);
      if (!$category->documents()->exists()) {
        $category->delete();
        DB::commit();
        return redirect()->route('categories.index')->success('Kategori berhasil di hapus');
      } else {
        Toaster::error('Kategori tidak dapat dihapus karena masih memiliki dokumen');
      }
    } catch (AuthorizationException $e) {
      Toaster::info('Anda tidak memiliki akses untuk menghapus kategori');
    } catch (\Exception $e) {
      DB::rollBack();
      Toaster::error('Terjadi kesalahan saat menghapus kategori');
    }
  }

  public function render()
  {
    $query = Category::query();

    if ($this->search) {
      $query->where('nama', 'like', '%' . $this->search . '%');
    }

    $categories = $query->latest()->paginate(5);
    return view('livewire.pages.category.index')->with('categories', $categories);
  }
}
