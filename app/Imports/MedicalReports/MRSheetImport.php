<?php

namespace App\Imports\MedicalReports;

// use Maatwebsite\Excel\Row;
// use Maatwebsite\Excel\Concerns\OnEachRow;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

// class MRSheetImport implements OnEachRow
//{
    // public function onRow(Row $row)
    // {

    // }
// }

class MRSheetImport implements ToCollection, WithCalculatedFormulas
{



    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
        //     // User::create([
        //     //     'name' => $row[0],
        //     // ]);
        }
    }
}