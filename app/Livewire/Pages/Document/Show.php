<?php

namespace App\Livewire\Pages\Document;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\Document;

class Show extends Component
{
  #[Layout('layouts.app')]
  #[Title('Detail Arsip')]
  public $document;
  public function mount(Document $document)
  {
    $this->document = $document;
  }
  public function render()
  {
    return view('livewire.pages.document.show');
  }
}
