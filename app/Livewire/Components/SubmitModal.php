<?php

namespace App\Livewire\Components;

use Livewire\Component;

class SubmitModal extends Component
{
  public $isOpen = false;

  public function openModal()
  {
    $this->isOpen = true;
  }
  public function closeModal()
  {
    $this->isOpen = false;
  }
  public function render()
  {
    return view('livewire.components.submit-modal');
  }
}
