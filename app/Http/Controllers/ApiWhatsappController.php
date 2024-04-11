<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiWhatsappController extends Controller
{
    public function getqr(Request $request)
    {
        $uri = $this->uri() . 'auth/getqr';
        $response = Http::get($uri);
        return response()->json($response->json());
    }
}
