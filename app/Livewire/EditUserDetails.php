<?php

namespace App\Livewire;

use Livewire\Component;

class EditUserDetails extends Component
{
    public $user;

    public $first_name, $last_name, $email, $phone, $address_line_1, $city, $state, $postcode, $country;

    public function mount($user)
    {
        // A jelenlegi felhasználói adatok beállítása
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->address_line_1 = $user->address_line_1;
        $this->city = $user->city;
        $this->state = $user->state;
        $this->postcode = $user->postcode;
        $this->country = $user->country;
    }

public function save()
{
    try {
        // Validáció
        $this->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'address_line_1' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'postcode' => 'required|string',
            'country' => 'required|string',
        ]);

        // Ellenőrizd, hogy van-e felhasználó
        if (!$this->user) {
            throw new \Exception("User instance not found.");
        }

        // Mentés
        $this->user->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address_line_1' => $this->address_line_1,
            'city' => $this->city,
            'state' => $this->state,
            'postcode' => $this->postcode,
            'country' => $this->country,
        ]);

        // Sikerüzenet
        session()->flash('success', 'User details updated successfully.');

    } catch (\Exception $e) {
        // Hiba kezelése
        session()->flash('error', 'An error occurred: ' . $e->getMessage());
    }
}


    public function render()
    {
        return view('livewire.edit-user-details');
    }
}
