<?php
namespace App\Http\Controllers\MedicalReports;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

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
        MRController::deleteTempFiles();
        
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
        if (MRController::decryptRequest($request)) {
            $requestValues = MRController::decryptRequest($request);
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

        $examsTypes = MRController::getExamsTypes($collection);

        return view('medical-reports.exams-types')->with ([
            'examsTypes' => $examsTypes,
            'path' => $path,
            'file' => $fileName,
            'sheetName' => $sheetName
        ]);

    }

    public function getExamsTypes($collection) 
    {
        $types = [
            "USG", 
            "RTG", 
            "MAM"
        ];
        $examsTypes = [];

        foreach ($collection as $items) 
        {
            foreach ($items as $row)
            {
                $tempCell = $row[0]; // column [A]

                if ($tempCell == '') {
                    $cellExam = $row[3]; // column [D]

                    //test
                    // echo "cell[D]: >>>$cellExam<<< <br>";

                    if ($cellExam != '') {
                       $cellValue = $cellExam;
                       $cellValue = preg_replace('/\s+/', '', $cellValue); //removing all whitespaces
                       if (in_array($cellValue, $types)) {
                            $examSection = true;
                            $skip = true;
                            $examsTypes[] = $cellValue;
                        }
                    }
                }
            }
        };

        return($examsTypes);
    }


    //
    //  Old function: not use
    //
    public function readSheet($request) 
    {
        
        try {
            $decrypted = Crypt::decryptString($request);
        } catch (DecryptException $e) {
            return view('medical-reports.index');
            //echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        
        $values = explode(";", $decrypted);
        $sheetName = $values[1];

        $Import = new GetSelectedSheet();
        $Import->onlySheets($values[0]);

        $collection = Excel::toCollection($Import, $path);

        $result = MRController::getAllResultTogether($collection);

        // Delete temporary uploaded files, if any
        // MRController::deleteTempFiles();

        return view('medical-reports.exams-types')->with([
            'file' => $originalFile,
            'sheetName' => $sheetName,
            'report' => $result
        ]);
    }

    public function showReport($request)
    {
        if (MRController::decryptRequest($request)) {
            $requestValues = MRController::decryptRequest($request);
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

        $priceList = MRController::getPrices($sheetName, $examType);
        $values = MRController::getResult($collection, $examType, $priceList);

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


    //
    //  Old function: not use
    //
    public function getAllResultTogether($collection)
    {
        /*
        //
        // $exam define array structure
        //
        $exam = [ 
            'name' => [String] 'exam name',
            'sumOfExam' => [Int],
            'payer' => [
                'name' => [String] 'payer name',
                'sum' => [Int]
            ]
        ];
        */
         $exam = [];

        /*
        //
        // $examsReport define array/collection structure
        //
        $examsReport = collect([
            [
                'examType' => [String]'type of exam',
                'sumOfExams' => [Int],
                'checkSumOfExams' => [Int],
                'exams' => [
                    $exam
                ]
            ]
        ]);
        */
        $examsReport = [];
        $report = []; // [$examsReport]

        $examTypes = [
            "USG", 
            "RTG", 
            "MAM"
        ];
        $defaultPayer = "wg. cennika przychodni";
        $payers = [
            "Płatne",
            "PZU",
            "ArcelorMittal S.A. Oddział w Zdzieszowicach"
        ];

        $cellExam = '';     // [D] - dla #sekcji# badan i [E]-dla badania
        $cellPayer = '';    // [C] - dla płatnika
        $tempCell = '';     // [A] - sprawdzanie wiersza
        $cellValue = '';
        $skip = false;
        $i = 0;

        $examType = "";
        $examSection = false;
        $examSum = 0;
        $checkSum = 0;

        foreach ($collection as $items) 
        {
            foreach ($items as $row)
            {
                ++$i;

                //test
                // echo "i: \($i) <- ";
                // echo $examSection ? 'true' : 'false';
                // echo " / ";
                // echo $skip ? 'true' : 'false';
                // echo "<br>";

                if ($skip) {
                    $skip = false;
                } else {
                    $tempCell = $row[0]; // column [A]

                    //test
                    // echo "tempCell[A]: $tempCell<br>";

                    if ($examSection) {
                        // section with exams is found
                        $cellExam = $row[4]; // column [E]

                        //test
                        // echo "cellExam[E]: $cellExam<br>";

                        if ($tempCell == '') { // column [A]
                            // checking Sum of exams same type

                            $checkSum = (Int)str_replace('Razem: ', '', $cellExam);

                            // test
                            // echo "<br>Cheksum of Exams: $checkSum<br>";

                            $examSection = false;

                            $counter = 0;
                            foreach ($exam as $item) {
                                $counter += $item['sumOfExam'];
                            };
                
                            //test
                            // echo "SUM of EXMAS: $counter<br>";

                            $examsReport[] = [
                                'examType' => $examType,
                                'sumOfExam' => $counter,
                                'exams' => [
                                    $exam
                                ]
                            ];
                            $exam = [];

                            // add another step on end of reading exams
                            // if read sums and calulated not equal

                        } else {
                            // there is any exam

                            $cellPayer = $row[2]; // column [C]

                            //test
                            // echo "cellPayer[C]: $cellPayer<br>";

                            in_array($cellPayer, $payers) ? $payer = $cellPayer : $payer = $defaultPayer;

                            //test
                            //echo "payer: $payer<br>";
                            
                            //
                            // check if exam and exam with payer was read before
                            //
                            $counter = 0;
                            $exam_index = 0;
                            $exam_exist = false;
                            foreach ($exam as $item) {
                                if ($item['name'] == $cellExam) {
                                    $exam_exist = true;
                                    $exam_index = $counter;
                                    
                                    //test
                                    // echo "Exam exist. Index [$exam_index]<br>";
                                };
                                ++$counter;
                            };
                            
                            if ($exam_exist) {
                                // Exam was read before

                                $exam[$exam_index]['sumOfExam'] += 1;

                                //test
                                // echo "<br>[222]. Exam was read before<br><br>";

                                $counter = 0;
                                $payer_exist = false;
                                foreach($exam[$exam_index]['payer'] as $item_payer) {

                                    //test
                                    // echo "[229] --$payer ->  ".$item_payer['name']." - :$counter<br>";

                                    if ($item_payer['name'] == $payer) {
                                        $payer_exist = true;
                                        $payer_index = $counter;
                                    }
                                    ++$counter;
                                }

                                if ($payer_exist) {

                                    //test
                                    // echo "[241] - PAYER exists in exam read before. Index: [$payer_index]<br><br>";

                                    $exam[$exam_index]['payer'][$payer_index]['sum'] += 1;

                                } else {
                                    //test
                                    // echo "[247] - ERROR PAYER NO exists in exam read before<br><br>";

                                    $exam[$exam_index]['payer'][] = [
                                        'name' => $payer,
                                        'sum' => 1
                                    ];
                                }


                            } else {    
                                // Exam read for the FIRST time

                                //test
                                // echo "Exam read for the FIRST time<br><br>";
                                
                                $exam [] = [
                                    'name' => $cellExam,
                                    'sumOfExam' => 1,
                                    'payer' => [[
                                        'name' => $payer,
                                        'sum' => 1
                                    ]]
                                ];
                            }
                        }
                    } else {
                        // lookin for section with exams
                        if ($tempCell == '') {
                            $cellExam = $row[3]; // column [D]

                            //test
                            // echo "cell[D]: >>>$cellExam<<< <br>";

                            if ($cellExam != '') {
                               $cellValue = $cellExam;
                               $cellValue = preg_replace('/\s+/', '', $cellValue); //removing all whitespaces
                               if (in_array($cellValue, $examTypes)) {
                                    $examSection = true;
                                    $skip = true;
                                    $examType = $cellValue;
                                }
                            }
                        }
                    }
                };
            }
        };

        return ($examsReport);
    }

    public function getResult($collection, $examType, $priceList)
    {
        /*
        //
        // $exams define array structure
        //
        $exams = [ 
            'name' => [String] 'exam name',
            'sumOfExam' => [Int],
            'amount' => [Floats],
            'payer' => [
                'name' => [String] 'payer name',
                'sum' => [Int],
                'amount => [Floats],
                'price' => [Floats]
            ]
        ];
        */
        $exams = [];
        $amount = 0;
        $price = 0;
        $defaultPayer = "wg. cennika przychodni";
        $payers = [
            "Płatne",
            "PZU",
            "ArcelorMittal S.A. Oddział w Zdzieszowicach"
        ];

        $cellExam = '';     // [D] - dla #sekcji# badan i [E]-dla badania
        $cellPayer = '';    // [C] - dla płatnika
        $tempCell = '';     // [A] - sprawdzanie wiersza
        $cellValue = '';
        $skip = false;
        $i = 0;

        // $examType = "";
        $examSection = false;
        $examSum = 0;
        $checkSum = 0;

        foreach ($collection as $items) 
        {
            foreach ($items as $row)
            {
                ++$i;

                //test
                // echo "i: \($i) <- ";
                // echo $examSection ? 'true' : 'false';
                // echo " / ";
                // echo $skip ? 'true' : 'false';
                // echo "<br>";

                if ($skip) {
                    $skip = false;
                } else {
                    $tempCell = $row[0]; // column [A]

                    //test
                    // echo "tempCell[A]: $tempCell<br>";

                    if ($examSection) {
                        // section with exams is found
                        $cellExam = $row[4]; // column [E]

                        //test
                        // echo "cellExam[E]: $cellExam<br>";

                        if ($tempCell == '') { // column [A]
                            // checking Sum of exams same type

                            $checkSum = (Int)str_replace('Razem: ', '', $cellExam);

                            // test
                            // echo "<br>Cheksum of Exams: $checkSum<br>";

                            $examSection = false;

                            $counter = 0;
                            foreach ($exams as $item) {
                                $counter += $item['sumOfExam'];
                                $amount += $item['amount'];
                            };
                
                            $sumOfExams = $counter;

                            //test
                            // echo "SUM of EXMAS: $counter<br>";

                            // add another step on end of reading exams
                            // if read sums and calulated not equal

                        } else {
                            // there is exam

                            $examPrices = [];
                            foreach ($priceList as $prices) {
                                if ($prices['name'] === $cellExam) {
                                    $examPrices = $prices['payers'];
                                }
                            }

                            $cellPayer = $row[2]; // column [C]

                            //test
                            // echo "cellPayer[C]: $cellPayer<br>";

                            in_array($cellPayer, $payers) ? $payer = $cellPayer : $payer = $defaultPayer;

                            //test
                            // echo "payer: $payer<br>";

                            //
                            // check if exam  was read before
                            //
                            $counter = 0;
                            $exam_index = 0;
                            $exam_exist = false;
                            foreach ($exams as $item) {
                                if ($item['name'] == $cellExam) {
                                    $exam_exist = true;
                                    $exam_index = $counter;
                                    
                                    //test
                                    // echo "Exam exist. Index [$exam_index]<br>";
                                };
                                ++$counter;
                            };
                            
                            if ($exam_exist) {
                                // Exam was read before

                                $exams[$exam_index]['sumOfExam'] += 1;

                                
                                //test
                                // echo "<br>[222]. Exam was read before<br><br>";

                                //
                                // check if exam with payer was read before
                                //
                                $counter = 0;
                                $payer_exist = false;
                                foreach($exams[$exam_index]['payer'] as $item_payer) {

                                    //test
                                    // echo "[229] --$payer ->  ".$item_payer['name']." - :$counter<br>";

                                    if ($item_payer['name'] == $payer) {
                                        $payer_exist = true;
                                        $payer_index = $counter;
                                    }
                                    ++$counter;
                                }

                                $price = 0;
                                if($examPrices) {
                                    foreach ($examPrices as $examPrice) {
                                        if ($examPrice['payer'] == $payer) {
                                            $price = $examPrice['price'];
                                            break;
                                        }
                                    }
                                }

                                if ($payer_exist) {

                                    //test
                                    // echo "[241] - PAYER exists in exam read before. Index: [$payer_index]<br><br>";

                                    $exams[$exam_index]['payer'][$payer_index]['sum'] += 1;
                                    $exams[$exam_index]['payer'][$payer_index]['amount'] += $price;
                                    $exams[$exam_index]['amount'] += $price;

                                } else {
                                    //test
                                    // echo "[247] - ERROR PAYER NO exists in exam read before<br><br>";

                                    $exams[$exam_index]['amount'] += $price;
                                    $exams[$exam_index]['payer'][] = [
                                        'name' => $payer,
                                        'sum' => 1,
                                        'amount' => $price,
                                        'price' => $price
                                    ];
                                }


                            } else {    
                                // Exam read for the FIRST time

                                //test
                                // echo "Exam read for the FIRST time<br><br>";

                                $price = 0;
                                if($examPrices) {
                                    foreach ($examPrices as $examPrice) {
                                        if ($examPrice['payer'] == $payer) {
                                            $price = $examPrice['price'];
                                            break; 
                                        }
                                    }
                                }
                                $exams[] = [
                                    'name' => $cellExam,
                                    'sumOfExam' => 1,
                                    'amount' => $price,
                                    'payer' => [[
                                        'name' => $payer,
                                        'sum' => 1,
                                        'amount' => $price,
                                        'price' => $price
                                    ]]
                                ];
                            }
                        }
                    } else {
                        // lookin for section with exams
                        if ($tempCell == '') {
                            $cellExam = $row[3]; // column [D]

                            //test
                            // echo "cell[D]: >>>$cellExam<<< <br>";

                            if ($cellExam != '') {
                               $cellValue = $cellExam;
                               $cellValue = preg_replace('/\s+/', '', $cellValue); //removing all whitespaces
                               if ($cellValue == $examType) {
                                    $examSection = true;
                                    $skip = true;
                                }
                            }
                        }
                    }
                };
            }
        };

        usort($exams, function($a, $b) {
            return $b['sumOfExam'] - $a['sumOfExam'];
        });

        return ([$exams, $sumOfExams, $amount]);
    }


    //
    // Get price list for specific doctor
    //
    public function getPrices($doctorName, $examType)
    {
        $priceList = [];
        $file ="/jsons/medical-reports/price-list.json";
        
        $contents = json_decode(Storage::get($file), true);
        $doctors = $contents['doctor'];
        foreach ($doctors as $doctor) {
            if ($doctor['name'] == $doctorName) {
                $examTypes = $doctor['examTypes'];
                foreach ($examTypes as $type) {
                    if ($type['type'] == $examType) {
                        $priceList = $type['exams'];
                        break;
                    } else {
                        return [];
                    }
                }
            } else {
                return [];
            }
        }
        return $priceList;
    }

    //
    // Delete temporary uploaded files
    //
    public function deleteTempFiles()
    {
        Storage::deleteDirectory($this->savePath);
    }

    //
    // Decrypt request
    //
    public function decryptRequest($request)
    {

        try {
            $decrypted = Crypt::decryptString($request);
        } catch (DecryptException $e) {
            return false;
        }
        
        return explode(";", $decrypted);
    }
}
