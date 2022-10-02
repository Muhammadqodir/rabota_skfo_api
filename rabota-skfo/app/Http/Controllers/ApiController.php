<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\University;
use App\Models\Vacancy;

class ApiController extends Controller
{

	public function getStat(){
		return json_encode(
				[
					"status" => 'ok',
					"total_vacancies" => Vacancy::count(),
					"total_resumes" => Resume::count(),
					"total_students" => Student::count(),
					"total_universities" => University::count()
				]
			);
	}

	public function getUnivers(){
		return University::all();
	}

}
