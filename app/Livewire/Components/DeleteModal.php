<?php

namespace App\Livewire\Components;

use Livewire\Component;

class DeleteModal extends Component
{
  public $id;
  public $name;
  public $isOpen = false;

  public function mount($id, $name)
  {
    $this->id = $id;
    $this->name = $name;
  }
  public function openModal()
  {
    $this->isOpen = true;
  }
  public function closeModal()
  {
    $this->isOpen = false;
  }

  public function destroy()
  {
    $this->dispatch('destroy', $this->id);
    $this->closeModal();
  }
  public function render()
  {
    return view('livewire.components.delete-modal');
  }
}
