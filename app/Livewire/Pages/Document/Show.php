<?php

namespace App\Livewire\Pages\Document;

use Livewire\Component;
use App\Models\Document;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;

class Show extends Component
{
  #[Layout('layouts.app')]
  #[Title('Detail Arsip')]
  public $document;
  public function mount(Document $document)
  {
    $this->document = $document;
  }
  public function download()
  {
    return Storage::disk('public')->download($this->document->file_path);
  }
  public function render()
  {
    return view('livewire.pages.document.show');
  }
}
