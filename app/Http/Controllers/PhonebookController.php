<?php

namespace App\Http\Controllers;

use App\Models\Phonebook;
use Illuminate\Http\Request;

class PhonebookController extends Controller
{
    public function index()
    {
        $phonebook = Phonebook::all();
        return view('phonebook.index', compact('phonebook'));
    }
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => ['required', 'string', 'unique:phonebooks,name'],
        ]);
        try {
            $validate['user_id'] = auth()->id();
            Phonebook::create($validate);
            return redirect()->back()->with('success', 'Phonebook created successfully');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error', 'Phonebook failed to create');
        }
    }
    public function destroy(Phonebook $phonebook)
    {
        try {
            $phonebook->delete();
            return response()->json([
                'message' => 'Phonebook deleted successfully'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Phonebook failed to delete'
            ], 500);
        }
    }
}
