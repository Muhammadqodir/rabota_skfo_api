<?php

namespace App\Http\Controllers;

use App\Exports\StudentsExport;
use App\Exports\StudentsExportModerator;
use App\Models\User;
use Illuminate\Http\Request;
use Excel;

class ExportExcelController extends Controller
{
    function studentsToExcel()
    {
     return Excel::download(new StudentsExport, 'Студенты.xlsx');
    }

    function studentsToExcelAll()
    {
     return Excel::download(new StudentsExportModerator, 'Студенты.xlsx');
    }
}
