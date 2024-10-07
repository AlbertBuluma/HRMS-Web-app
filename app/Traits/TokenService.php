<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait TokenService
{

    protected $tokenEndpoint = 'host.docker.internal:8020/api/register'; // The endpoint to request the token

    /**
     * Request a bearer token from the third-party app
     *
     * @return string
     */
    public function requestToken()
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post($this->tokenEndpoint, [
            'name' => env('HRMS_API_USER'),     // Client name
            'email' => env('HRMS_API_EMAIL'), // Client password
            'password' => env('HRMS_API_USER_PASSWORD'),   // password
            'password_confirmation' => env('HRMS_API_USER_PASSWORD'),  // confirm password
        ]);

        if ($response->successful()) {
            // Save the token in the cache (or database if needed)
            $token = $response->json()['data']['token'];
            cache(['bearer_token' => $token]); // Cache for 60 minutes
            return $token;
        }
//            dd($response->json()['data']['token']);

        throw new \Exception('Failed to obtain token from the third party');
    }

    public function getToken()
    {
        // Check if the token exists in cache
        if (cache()->has('bearer_token')) {
            return cache('bearer_token');
        }

        // If not in cache, request a new token
        return $this->requestToken();
    }


}
