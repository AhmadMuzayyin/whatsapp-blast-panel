<?php

namespace App\Http\Controllers;

use App\Exports\ContactExport;
use App\Imports\ContactImport;
use App\Models\Contact;
use App\Models\Phonebook;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validate = $request->validate([
            'phonebook_id' => ['required', 'exists:phonebooks,id'],
            'name' => ['required', 'string'],
            'number' => ['required', 'string'],
        ]);
        try {
            Contact::create($validate);
            return response()->json([
                'message' => 'Contact created successfully'
            ], 200);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return response()->json([
                'message' => 'Contact failed to create'
            ], 500);
        }
    }
    public function import(Request $request)
    {
        $validate = $request->validate([
            'phonebook_id' => ['required', 'exists:phonebooks,id'],
            'file' => ['required', 'file', 'mimes:xlsx'],
        ]);
        try {
            Excel::import(new ContactImport($validate['phonebook_id']), $validate['file']);
            return response()->json([
                'message' => 'Contacts imported successfully'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Contacts failed to import'
            ], 500);
        }
    }
    public function export(Phonebook $phonebook)
    {
        try {
            return Excel::download(new ContactExport($phonebook->id), 'contacts.xlsx');
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Contacts failed to export'
            ], 500);
        }
    }
    public function show(Phonebook $phonebook)
    {
        $contacts = Contact::where('phonebook_id', $phonebook->id)->get();
        return response()->json([
            'contacts' => $contacts
        ], 200);
    }
    public function delete(Contact $contact)
    {
        try {
            $contact->delete();
            return response()->json([
                'message' => 'Contact deleted successfully'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Contact failed to delete'
            ], 500);
        }
    }
    public function deleteAll(Phonebook $phonebook)
    {
        try {
            Contact::where('phonebook_id', $phonebook->id)->delete();
            return response()->json([
                'message' => 'Contacts deleted successfully'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Contacts failed to delete'
            ], 500);
        }
    }
}
