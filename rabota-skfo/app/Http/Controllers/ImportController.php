<?php

namespace App\Http\Controllers;

use App\Imports\StudentsImport;
use App\Imports\StudentsImportModerator;
use Illuminate\Http\Request;
use Excel;
use Illuminate\Support\Facades\Auth;

class ImportController extends Controller
{
    public function importStudents(Request $request){
        $file = $request->file('importFile');

        $fileName = 'import_'.Auth::user()->id.'.xlsx';
        $file->move(public_path('uploads/imports'), $fileName);
        
        Excel::import(new StudentsImport, public_path('uploads/imports/'.$fileName));
        return redirect()->back()->with('alert', 'Готово!');
    }

    public function importStudentsMD(Request $request){
        $file = $request->file('importFile');

        $fileName = 'import_'.Auth::user()->id.'.xlsx';
        $file->move(public_path('uploads/imports'), $fileName);
        
        Excel::import(new StudentsImportModerator, public_path('uploads/imports/'.$fileName));
        return redirect()->back()->with('alert', 'Готово!');
    }
}
