<?php

namespace App\Http\Controllers;

use App\Models\WhatsappAccount;

class DashboardController extends Controller
{
    public function index()
    {
        $whatsapps = WhatsappAccount::with('message_sent')->get();

        return view('dashboard', compact('whatsapps'));
    }
}
