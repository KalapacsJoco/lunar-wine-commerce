<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Location\Facades\Location; // Telepített geolokációs csomag
use Illuminate\Support\Facades\Auth;

class RegisterModal extends Component
{
    // Mezők a formhoz
    public $first_name, $last_name, $email, $password, $password_confirmation;
    public $phone, $address_line_1, $address_line_2, $city, $state, $postcode, $country, $birth_date;

    // Modal állapota
    public $showModal = false;
    public $requiredAge;



    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
        'phone' => 'required',
        'address_line_1' => 'required',
        'city' => 'required',
        'state' => 'required',
        'postcode' => 'required',
        'country' => 'required',
        'birth_date' => ['required', 'date'], // Ezt dinamikusan ellenőrizzük a "validate()" belül
    ];

    public function mount()
    {

        // Determine the country based on the IP


        // IP alapján az ország meghatározása
        $userIp = request()->ip();
        $location = Location::get($userIp);

        $this->country = $location ? $location->countryCode : 'US'; // Alapértelmezett ország US
        $this->requiredAge = ($this->country === 'US') ? 21 : 18;
    }

    public function register()
    {
        // Dinamikus életkor validáció hozzáadása
        $this->rules['birth_date'][] = "before:-{$this->requiredAge} years";

        $this->validate();

        // Felhasználó létrehozása
       $user = User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'phone' => $this->phone,
            'address_line_1' => $this->address_line_1,
            'address_line_2' => $this->address_line_2,
            'city' => $this->city,
            'state' => $this->state,
            'postcode' => $this->postcode,
            'country' => $this->country,
            'birth_date' => $this->birth_date,
        ]);

        // Automatikus bejelentkeztetés
        Auth::login($user);

        // Átirányítás a dashboard-ra
        return redirect()->to('/dashboard');
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.register-modal');
    }
}
