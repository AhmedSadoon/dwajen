<?php

namespace App\Exports;

use App\Models\Incomes;
use Maatwebsite\Excel\Concerns\FromCollection;

class IncomesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Incomes::all();
    }
}
