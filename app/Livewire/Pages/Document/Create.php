<?php

namespace App\Livewire\Pages\Document;

use Livewire\Component;
use App\Models\Category;
use App\Models\Document;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Masmerise\Toaster\Toaster;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Auth\Access\AuthorizationException;

class Create extends Component
{
  use WithFileUploads;

  #[Layout('layouts.app')]
  #[Title('Buat Arsip')]

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

  #[Validate('required', message: 'Dokumen tidak boleh kosong')]
  #[Validate('mimes:pdf', message: 'Dokumen harus berformat PDF')]
  #[Validate('max:10240', message: 'Dokumen tidak boleh lebih dari 10MB')]
  public $document;

  public function mount()
  {
    $this->categories = Category::all();
  }

  public function store()
  {
    try {
      $this->authorize('create', Document::class);
      DB::beginTransaction();
      $this->validate([
        'selectedCategory' => 'required|exists:categories,id',
        'document' => 'required|mimes:pdf|max:10240'
      ]);

      $fileName = 'ARSIP' . '-' . now()->format('Y-m-d-H-i-s') . '.' . $this->document->getClientOriginalExtension();
      $documentPath = Storage::disk('public')->putFileAs('documents', $this->document, $fileName);
      Document::create([
        'slug' => Str::random(10),
        'judul' => $this->title,
        'nomor_surat' => $this->nomorSurat,
        'category_id' => $this->selectedCategory,
        'file_path' => $documentPath,
        'editor_id' => Auth::user()->id
      ]);
      DB::commit();
      return redirect()->route('documents.index')->success('Dokumen berhasil dibuat');
    } catch (AuthorizationException $e) {
      Toaster::warning('Anda tidak memiliki akses untuk membuat arsip');
    } catch (\Exception $e) {
      DB::rollBack();
      Toaster::error('Gagal membuat arsip');
    }
  }

  public function render()
  {
    return view('livewire.pages.document.create');
  }
}
