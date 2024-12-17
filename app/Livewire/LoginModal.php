<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LoginModal extends Component
{
    public $email, $password, $remember = false;

    public function login()
    {
        // Validáció
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Bejelentkezési logika
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            session()->flash('success', 'Login successful!');
            return redirect()->to('/dashboard'); // Navigáció
        }

        session()->flash('error', 'Invalid credentials');
    }

    public function render()
    {
        return view('livewire.login-modal');
    }
}

