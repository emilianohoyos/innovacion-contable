<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;

class GraphTokenService
{
    public static function getAccessToken()
    {
        $response = Http::asForm()->post('https://login.microsoftonline.com/' . env('GRAPH_TENANT_ID') . '/oauth2/v2.0/token', [
            'client_id' => env('GRAPH_CLIENT_ID'),
            'client_secret' => env('GRAPH_CLIENT_SECRET'),
            'grant_type' => 'client_credentials',
            'scope' => 'https://graph.microsoft.com/.default',
        ]);

        if ($response->successful()) {
            return $response->json()['access_token'];
        }

        throw new \Exception('Failed to retrieve access token: ' . $response->body());
    }
}
