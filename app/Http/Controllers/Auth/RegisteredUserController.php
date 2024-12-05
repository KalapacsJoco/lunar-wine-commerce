<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Services\GeolocationService; // A GeolocationService osztály használata
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules;
use Lunar\Models\Customer; // Lunar Customer modell

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Services\GeolocationService  $geoService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, GeolocationService $geoService)
    {
        // Felhasználó IP-címének lekérése
        $userIp = $request->ip();

        // Ország meghatározása az IP alapján
        $country = $geoService->getCountryFromIp($userIp);

        // Életkor meghatározása: 18 év alapértelmezett, 21 év, ha az ország USA
        $requiredAge = ($country === 'US') ? 21 : 18;

        // Validáció a dinamikus életkor alapján
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'birth_date' => ['required', 'date', "before:-{$requiredAge} years"], // Dinamikus életkor ellenőrzés
        ]);

        // Létrehozunk egy új User rekordot
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birth_date' => $request->birth_date,
        ]);

        // Automatikusan létrehozzuk a Lunar Customer rekordot
        Customer::create([
            'user_id' => $user->id,
            'first_name' => $request->name,
            'last_name' => '', // Ha nincs last_name, hagyd üresen
        ]);

        // Esemény indítása
        event(new Registered($user));

        // Felhasználó bejelentkeztetése
        Auth::login($user);

        return redirect(route('dashboard'));
    }
}
