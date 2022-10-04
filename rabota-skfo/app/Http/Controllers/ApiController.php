<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Resume;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Resources\UniverLess;
use App\Http\Resources\UniverMore;
use App\Http\Resources\StudentLess;
use App\Models\University;
use App\Models\User;
use App\Models\Vacancy;

class ApiController extends Controller
{

	public function getStat()
	{
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

	public function getStatByRegion(Request $request)
	{
		try {
			$regionId = $request->input("regionId");
			return json_encode(
				[
					"status" => 'ok',
					"total_vacancies" => Vacancy::select('vacancies.*')
					->join('users', 'users.id', '=', 'vacancies.user_id')
					->where('users.region_id', $regionId)->count(),
					
					"total_resumes" => Resume::select('resumes.*')
					->join('users', 'users.id', '=', 'resumes.user_id')
					->where('users.region_id', $regionId)->count(),

					"total_students" => User::where('role', "student")->where('region_id', $regionId)->count(),

					"total_universities" => User::where('role', "university")->where('region_id', $regionId)->count(),
				]
			);
		} catch (\Throwable $th) {
			return json_encode([
				"status" => "Bad request",
				"error" => $th
			]);
		}
	}

	public function getRegions()
	{
		return json_encode(
			[
				"status" => "ok",
				"regions" => Region::all()
			]
		);
	}

	public function getUnivers()
	{
		return json_encode([
			"status" => "ok",
			"data" => University::all()
		]);
	}

	public function getUniversByRegion(Request $request)
	{
		try {
			$regionId = $request->input("regionId");
			return json_encode([
				"status" => "ok",
				"data" => UniverLess::collection(University::select('universities.*')
				->join('users', 'users.details', '=', 'universities.id')
				->where('users.role', 'university')
				->where('users.region_id', $regionId)->get())
			]);
		} catch (\Throwable $th) {
			return json_encode([
				"status" => "Bad request",
				"error" => $th
			]);
		}
	}

	public function getUniver(Request $request, $id)
	{
		try {
			return json_encode([
				"status" => "ok",
				"data" => new UniverMore(University::findOrFail($id))
			]);
		} catch (\Throwable $th) {
			return json_encode([
				"status" => "Bad request",
				"error" => $th
			]);
		}
	}

	public function getUniverStudents(Request $request, $id)
	{
		try {
			return json_encode([
				"status" => "ok",
				"data" => StudentLess::collection(Student::where('university_id', $id)->get())
			]);
		} catch (\Throwable $th) {
			return json_encode([
				"status" => "Bad request",
				"error" => $th
			]);
		}
	}

	public function getStudents(Request $request)
	{
		try {
			return json_encode([
				"status" => "ok",
				"data" => StudentLess::collection(Student::all())
			]);
		} catch (\Throwable $th) {
			return json_encode([
				"status" => "Bad request",
				"error" => $th
			]);
		}
	}
}
