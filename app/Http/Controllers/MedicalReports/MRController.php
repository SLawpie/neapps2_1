<?php
namespace App\Http\Controllers\MedicalReports;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use App\Http\Services\MRService;
use App\Http\Services\DecryptService;
use Illuminate\Support\Collection;

use App\Imports\GetSheetsNames;
use App\Imports\GetSelectedSheet;

class MRController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->savePath = 'mrdata';
    }

    public function index()
    {
        return view('medical-reports.index');
    }

    public function importFile(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:5000|mimes:xls,xlsx',
        ]);

        // Delete temporary uploaded files, if any
        // MRController::deleteTempFiles();
        MRService::deleteTempFiles($this->savePath);

        $file = $request->file;
        $path = $request->file->store($this->savePath);
        $originalFile = $request->file->getClientOriginalName();

        $Import = new GetSheetsNames();
        Excel::import($Import, $path);
        $sheetsNames = $Import->getSheetsNames();

        return view('medical-reports.sheets')->with([
            'sheetsNames' => $sheetsNames,
            'path' => $path,
            'file' => $originalFile
        ]);
    }   

    public function readExamsTypes($request) 
    {
        if (DecryptService::decryptRequest($request)) {
            $requestValues = DecryptService::decryptRequest($request);
        } else {
            return view('medical-reports.index'); 
        }

        if (!Storage::exists($requestValues[1])) {
            return view('medical-reports.index');
         }
        $path = $requestValues[1];
        
        $sheetIndex = $requestValues[0];
        $fileName = $requestValues[2];
        $sheetName = $requestValues[3];

        $Import = new GetSelectedSheet();
        $Import->onlySheets($sheetIndex);
        
        $collection = Excel::toCollection($Import, $path);

        // $examsTypes = MRController::getExamsTypes($collection);
        $examsTypes = MRService::getExamsTypes($collection);

        return view('medical-reports.exams-types')->with ([
            'examsTypes' => $examsTypes,
            'path' => $path,
            'file' => $fileName,
            'sheetName' => $sheetName
        ]);

    }

    public function showReport($request)
    {
        if (DecryptService::decryptRequest($request)) {
            $requestValues = DecryptService::decryptRequest($request);
        } else {
            return view('medical-reports.index'); 
        }
        
        if (!Storage::exists($requestValues[1])) {
            return view('medical-reports.index');
         }
        $path = $requestValues[1];
        

        $fileName = $requestValues[2];
        $sheetName = $requestValues[3];
        $examType = $requestValues[4];

        $Import = new GetSelectedSheet();
        $Import->onlySheets($requestValues[3]);
        
        $collection = Excel::toCollection($Import, $path);

        $priceList = MRService::getPrices($sheetName, $examType);
        $values = MRService::getResult($collection, $examType, $priceList);

        // Delete temporary uploaded files, if any
        // MRController::deleteTempFiles();

        return view('medical-reports.report')->with([
            'exams' => $values[0],
            'sumOfExams' => $values[1],
            'file' => $fileName,
            'sheetName' => $sheetName,
            'examType' => $examType,
            'amount' => $values[2]
        ]);
    }
}
