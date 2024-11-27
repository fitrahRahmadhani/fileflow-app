<?php

namespace App\Livewire\Pages\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\WithoutUrlPagination;

class Index extends Component
{
  use WithPagination, WithoutUrlPagination;

  #[Layout('layouts.app')]
  #[Title('Kategori')]

  public $search;

  public function render()
  {
    $query = Category::query();

    if ($this->search) {
      $query->where('nama', 'like', '%' . $this->search . '%');
    }

    $categories = $query->latest()->paginate(5);
    return view('livewire.pages.category.index')->with('categories', $categories);
  }
}
