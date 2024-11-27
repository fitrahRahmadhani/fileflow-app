<?php

namespace App\Livewire\Pages\Category;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class Index extends Component
{
  #[Layout('layouts.app')]
  #[Title('Kategori')]
  public function render()
  {
    return view('livewire.pages.category.index');
  }
}
