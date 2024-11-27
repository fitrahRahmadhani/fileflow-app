<?php

namespace App\Livewire\Pages\Document;

use Livewire\Component;
use App\Models\Document;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\WithoutUrlPagination;

class Index extends Component
{
  use WithPagination, WithoutUrlPagination;

  #[Layout('layouts.app')]
  #[Title('Arsip')]

  public $search;

  public function render()
  {
    $query = Document::query();

    if ($this->search) {
      $query->where('judul', 'like', '%' . $this->search . '%')
        ->orWhere('nomor_surat', 'like', '%' . $this->search . '%');
    }

    $documents = $query->latest()->paginate(10);

    return view('livewire.pages.document.index')->with('documents', $documents);
  }
}
