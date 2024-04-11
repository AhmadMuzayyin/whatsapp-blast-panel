<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlastRequest;
use App\Jobs\BlastJob;
use App\Models\Blast;
use App\Models\Phonebook;
use Illuminate\Http\Request;

class BlastController extends Controller
{
    public function index()
    {
        // $blasts = Blast::where('user_id', auth()->id())->get();
        $blasts = Blast::get();
        $phonebooks = Phonebook::where('user_id', auth()->id())->get();
        return view('blast.index', compact('blasts', 'phonebooks'));
    }
    public function store(BlastRequest $request)
    {
        $validate = $request->validated();
        try {
            $validate['scheduled_at'] = $request->scheduled_at ? $request->scheduled_at : now()->addMinutes(3);
            BlastJob::dispatch();
            Blast::create($validate);
            return redirect()->back()->with('success', 'Blast created successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', 'Failed to create blast');
        }
    }
    public function destroy(Blast $blast)
    {
        try {
            $blast->delete();
            return response()->json(['message' => 'Blast deleted successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Failed to delete blast']);
        }
    }
}
