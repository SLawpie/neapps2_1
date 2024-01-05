<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;

class GetSheetsNames implements WithEvents {
    
    public $sheetsNames;

    public function __construct()
    {
        $this->sheetsNames = [];
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function(BeforeSheet $event) 
                {
                    $this->sheetsNames[] = $event->getSheet()->getDelegate()->getTitle();
                }
        ];
    }

    public function getSheetsNames() 
    {
        return $this->sheetsNames;
    }
}