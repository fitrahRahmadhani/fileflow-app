<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;

class Header extends Component
{
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function logout(Logout $logout)
    {
        $logout();

        return redirect()->route('login');
    }
    public function render()
    {
        return view('livewire.components.header');
    }
}
