<?php

namespace App\Imports;

use App\Models\Contact;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ContactImport implements ToCollection
{
    protected $phonebook_id;
    public function __construct($phonebook_id)
    {
        $this->phonebook_id = $phonebook_id;
    }
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $value) {
            Contact::create([
                'phonebook_id' => $this->phonebook_id,
                'name' => $value[0],
                'number' => $value[1],
            ]);
        }
    }
}
