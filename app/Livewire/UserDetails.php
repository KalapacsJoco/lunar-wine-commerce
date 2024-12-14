<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class UserDetails extends Component
{
    public $user;

    public function mount()
    {
        // Lekérjük az aktuális felhasználót
        $this->user = Auth::user();
    }

    public function render(): View
    {
        return view('livewire.user-details');
    }
}
