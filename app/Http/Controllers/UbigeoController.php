<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class UbigeoController extends Controller
{
    private function api()
    {
        return Http::withHeaders([
            'X-API-Key' => env('PERU_API_KEY'),
        ])->baseUrl(env('PERU_API_URL'));
    }

    public function departamentos()
    {
        $response = $this->api()->get('/ubigeo/departamentos');
        return response()->json($response->json());
    }

    public function provincias( string $codigo)
    {
        $response = $this->api()->get('/ubigeo/provincias', [
            'departamento' => $codigo,
        ]);
        return response()->json($response->json());
    }

    public function distritos( string $codigo)
    {
        $response = $this->api()->get('/ubigeo/distritos', [
            'provincia' => $codigo,
        ]);
        return response()->json($response->json());
    }
}