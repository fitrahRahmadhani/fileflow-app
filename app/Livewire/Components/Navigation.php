<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Livewire\Actions\Logout;

class Navigation extends Component
{
  public function logout(Logout $logout)
  {
    $logout();

    return redirect()->route('login'); // Menggunakan redirect yang sesuai.
  }
  public function render()
  {
    return view('livewire.components.navigation');
  }
}
