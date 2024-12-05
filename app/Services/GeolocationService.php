<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeolocationService
{
    /**
     * Lekéri a felhasználó országát az IP-címe alapján.
     *
     * @param string $ip
     * @return string|null Az országkód (pl. "US", "HU") vagy null, ha hiba történik.
     */
    public function getCountryFromIp(string $ip): ?string
    {
        // API kulcs az ipstack szolgáltatáshoz (regisztrálj itt: https://ipstack.com/)
        $apiKey = env('IPSTACK_API_KEY');

        // API hívás az ipstack-hez
        $response = Http::get("http://api.ipstack.com/{$ip}?access_key={$apiKey}");

        if ($response->successful()) {
            // Az országkód visszaadása (pl. "US")
            return $response->json()['country_code'] ?? null;
        }

        return null; // Hibás válasz esetén null-t ad vissza
    }
}
