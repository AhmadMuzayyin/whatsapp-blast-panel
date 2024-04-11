<?php

namespace App\Exports;

use App\Models\Contact;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class ContactExport implements FromView
{
    protected $phonebook_id;
    public function __construct($phonebook_id)
    {
        $this->phonebook_id = $phonebook_id;
    }

    public function view(): View
    {
        return view('phonebook.export', [
            'contacts' => Contact::where('phonebook_id', $this->phonebook_id)->get()
        ]);
    }
}
