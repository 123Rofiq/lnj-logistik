<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\DataExport;
use App\Imports\DataImport;
use Maatwebsite\Excel\Facades\Excel;
// use App\Data;

class ImportController extends Controller
{
    public function importExportView()
    {
       return view('import');
    }
   
    public function export() 
    {
        return Excel::download(new DataExport, 'data.xlsx');
    }
   
    public function import() 
    {
        Excel::import(new DataImport,request()->file('file'));
           
        return redirect()->back();
    }
}
