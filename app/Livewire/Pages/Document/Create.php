<?php

namespace App\Livewire\Pages\Document;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class Create extends Component
{
  public $search;
  public function render()
  {
    return view('livewire.pages.document.create');
  }
}
