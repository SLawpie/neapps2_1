<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;

use App\Imports\MedicalReports\MRSheetImport;

class GetSelectedSheet implements WithMultipleSheets 
{
    use WithConditionalSheets;

    public function conditionalSheets(): array
    {
        return [
            $this->conditionallySelectedSheets[0] => new MRSheetImport(),
        ];
    }
}