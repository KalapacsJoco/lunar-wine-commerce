<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Services\GeolocationService; // GeolocationService for country detection
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules;
use Lunar\Models\Customer;
use Lunar\Models\Address;
use Lunar\Models\Country;

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
        // Get user's IP address
        $userIp = $request->ip();

        // Determine the country based on the IP
        $country = $geoService->getCountryFromIp($userIp) ?? 'Unknown';

        // Define minimum age based on the country
        $requiredAge = ($country === 'US') ? 21 : 18;

        // Validate the registration form
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'string', 'max:255'],
            'address_line_1' => ['required', 'string', 'max:255'],
            'address_line_2' => ['nullable', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'postcode' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date', "before:-{$requiredAge} years"],
        ]);

        // Find the country in the Lunar countries table
        $countryRecord = Country::where('name', $request->country)->first();
        if (!$countryRecord) {
            return back()->withErrors(['country' => 'The selected country is not supported.']);
        }

        // Create a new user
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address_line_1' => $request->address_line_1,
            'address_line_2' => $request->address_line_2,
            'city' => $request->city,
            'state' => $request->state,
            'postcode' => $request->postcode,
            'country' => $request->country,
            'birth_date' => $request->birth_date,
        ]);

        // Create a Lunar Customer record
        $customer = Customer::create([
            'user_id' => $user->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ]);

        // Create a Lunar Address record
        Address::create([
            'customer_id' => $customer->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'line_one' => $request->address_line_1,
            'line_two' => $request->address_line_2,
            'city' => $request->city,
            'state' => $request->state,
            'postcode' => $request->postcode,
            'country_id' => $countryRecord->id, // Use the country ID from Lunar
        ]);

        // Trigger the registered event
        event(new Registered($user));

        // Log in the user
        Auth::login($user);

        return redirect(route('dashboard'));
    }
}
