<?php

namespace App\Livewire\Pages\Profil;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class Index extends Component
{
  #[Layout('layouts.app')]
  #[Title('Profil')]
  public function render()
  {
    return view('livewire.pages.profil.index');
  }
}
