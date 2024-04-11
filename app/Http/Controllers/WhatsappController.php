<?php

namespace App\Http\Controllers;

use App\Http\Requests\WhatsappRequest;
use App\Models\WhatsappAccount;

class WhatsappController extends Controller
{
    public function store(WhatsappRequest $request)
    {
        try {
            $validated = $request->validated();
            $validated['user_id'] = auth()->id();
            $whatsapp = WhatsappAccount::where('user_id', auth()->id())->first();
            if ($whatsapp && $whatsapp->count() >= 10) {
                return redirect()->back()->withInput()->with('info', 'You can only have 10 whatsapp accounts');
            } else {
                $whatsapp = WhatsappAccount::create($validated);
                return back()->with('success', 'Whatsapp account created successfully');
            }
        } catch (\Throwable $th) {
            return back()->withInput()->withErrors($th->getMessage());
        }
    }

    public function destroy(WhatsappAccount $whatsapp)
    {
        try {
            $whatsapp->delete();

            return response()->json(['message' => 'Whatsapp account deleted successfully']);
        } catch (\Throwable $th) {
            return back()->withErrors($th->getMessage());
        }
    }

    public function scan(WhatsappAccount $whatsapp)
    {
        return view('whatsapp.scan', compact('whatsapp'));
    }
}
