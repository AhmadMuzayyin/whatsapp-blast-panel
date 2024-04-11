<?php

namespace App\Http\Controllers;

use App\Models\WhatsappAccount;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function change(Request $request)
    {
        $request->validate([
            'device' => ['required', 'string']
        ]);
        $device = WhatsappAccount::where('id', $request->device)->first();
        session()->put('device', $device);
        return response()->json([
            'message' => 'Device changed successfully'
        ], 200);
    }
}
