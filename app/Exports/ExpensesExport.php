<?php

namespace App\Exports;

use App\Models\expenses;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExpensesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return expenses::all();
    }
}
