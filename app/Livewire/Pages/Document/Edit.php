<?php

namespace App\Livewire\Pages\Document;

use Livewire\Component;
use App\Models\Category;
use App\Models\Document;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Masmerise\Toaster\Toaster;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Auth\Access\AuthorizationException;

class Edit extends Component
{
  use WithFileUploads;
  #[Layout('layouts.app')]
  #[Title('Edit Dokumen')]

  public Document $document;
  public $categories;

  #[Validate('required', message: 'Input field nomor surat tidak boleh kosong')]
  #[Validate('min:3', message: 'Input field nomor surat tidak boleh kurang dari 3 karakter')]
  #[Validate('max:100', message: 'Input field nomor surat tidak boleh lebih dari 100 karakter')]
  public $nomorSurat;

  #[Validate('required', message: 'Input field judul surat tidak boleh kosong')]
  #[Validate('min:10', message: 'Input field judul surat tidak boleh kurang dari 10 karakter')]
  #[Validate('max:100', message: 'Input field judul surat tidak boleh lebih dari 100 karakter')]
  public $title;

  #[Validate('required', message: 'Kategori tidak boleh kosong')]
  #[Validate('exists:categories,id', message: 'Kategori tidak ditemukan')]
  public $selectedCategory;

  #[Validate('mimes:pdf', message: 'Dokumen harus berformat PDF')]
  #[Validate('max:10240', message: 'Dokumen tidak boleh lebih dari 10MB')]
  public $newDocument;

  public function mount(Document $document)
  {
    $this->document = $document;
    $this->nomorSurat = $document->nomor_surat;
    $this->title = $document->judul;
    $this->categories = Category::all();
    $this->selectedCategory = $document->category_id;
  }

  public function update()
  {
    try {
      $this->authorize('update', $this->document);
      DB::beginTransaction();
      $this->validate([
        'selectedCategory' => 'required|exists:categories,id',
        'title' => 'required|string|max:255',
        'nomorSurat' => 'required|string|max:255',
      ]);
      if ($this->newDocument) {
        $this->validate([
          'newDocument' => 'mimes:pdf|max:10240',
        ]);
        Storage::disk('public')->delete($this->document->file_path);
        $fileName = 'ARSIP' . '-' . now()->format('Y-m-d-H-i-s') . '.' . $this->newDocument->getClientOriginalExtension();
        $documentPath = Storage::disk('public')->putFileAs('documents', $this->newDocument, $fileName);
        $this->document->update([
          'file_path' => $documentPath
        ]);
      }
      $this->document->update([
        'judul' => $this->title,
        'nomor_surat' => $this->nomorSurat,
        'category_id' => $this->selectedCategory,
      ]);
      DB::commit();
      return redirect()->route('documents.index')->success('Dokumen berhasil diubah');
    } catch (AuthorizationException $e) {
      Toaster::warning('Anda tidak memiliki akses untuk mengubah arsip');
    } catch (\Exception $e) {
      DB::rollBack();
      Toaster::error('Gagal mengubah arsip');
    }
  }
  public function render()
  {
    return view('livewire.pages.document.edit');
  }
}
