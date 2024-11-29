<?php

namespace App\Livewire\Pages\Document;

use Livewire\Component;
use App\Models\Document;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Masmerise\Toaster\Toaster;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\Storage;
use Illuminate\Auth\Access\AuthorizationException;

class Index extends Component
{
  use WithPagination, WithoutUrlPagination;

  #[Layout('layouts.app')]
  #[Title('Arsip')]

  public $search;

  public function updateSearch()
  {
    $this->resetPage();
  }

  #[On('destroy')]
  public function destroy($id)
  {
    try {
      $document = Document::find($id);
      $this->authorize('delete', $document);
      DB::beginTransaction();
      Storage::disk('public')->delete($this->document->file_path);
      $document->delete();
      DB::commit();
      return redirect()->route('documents.index')->success('Dokumen berhasil dihapus');
    } catch (AuthorizationException $e) {
      Toaster::warning('Anda tidak memiliki akses untuk menghapus arsip');
    } catch (\Exception $e) {
      DB::rollBack();
      Toaster::error('Terjadi kesalahan saat menghapus arsip');
    }
  }

  public function render()
  {
    $query = Document::query();

    if ($this->search) {
      $query->where('judul', 'like', '%' . $this->search . '%')
        ->orWhere('nomor_surat', 'like', '%' . $this->search . '%');
    }

    $documents = $query->latest()->paginate(5);

    return view('livewire.pages.document.index')->with('documents', $documents);
  }
}
