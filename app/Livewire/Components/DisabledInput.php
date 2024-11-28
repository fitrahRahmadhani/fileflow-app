<?php

namespace App\Livewire\Components;

use Livewire\Component;

class DisabledInput extends Component
{
  public $label;
  public $content;

  public function mount($label, $content)
  {
    $this->label = $label;
    $this->content = $content;
  }

  public function render()
  {
    return view('livewire.components.disabled-input');
  }
}
