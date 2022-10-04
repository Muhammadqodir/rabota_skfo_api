<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Resume;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Resources\UniverLess;
use App\Http\Resources\UniverMore;
use App\Http\Resources\OrganizationMore;
use App\Http\Resources\StudentLess;
use App\Http\Resources\ResumeLess;
use App\Http\Resources\VacancyLess;
use App\Http\Resources\StudentMore;
use App\Models\University;
use App\Models\Organization;
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
					"region" => Region::find($regionId)->name,
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
				"region" => Region::find($regionId)->name,
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

	public function getStudentsByRegion(Request $request)
	{
		try {
			$regionId = $request->input("regionId");
			return json_encode([
				"status" => "ok",
				"region" => Region::find($regionId)->name,
				"data" => StudentLess::collection(Student::select('students.*')
				->join('users', 'users.details', '=', 'students.id')
				->where('users.role', 'student')
				->where('users.region_id', $regionId)->get())
			]);
		} catch (\Throwable $th) {
			return json_encode([
				"status" => "Bad request",
				"error" => $th
			]);
		}
	}

	public function getStudentsByUniver(Request $request)
	{
		try {
			$univer_id = $request->input("universityId");
			return json_encode([
				"status" => "ok",
				"data" => StudentLess::collection(Student::where('university_id', $univer_id)->get())
			]);
		} catch (\Throwable $th) {
			return json_encode([
				"status" => "Bad request",
				"error" => $th
			]);
		}
	}

	public function getStudent(Request $request, $id)
	{
		try {
			return json_encode([
				"status" => "ok",
				"data" => new StudentMore(Student::findOrFail($id))
			]);
		} catch (\Throwable $th) {
			return json_encode([
				"status" => "Bad request",
				"error" => $th
			]);
		}
	}
	public function getStudentResume(Request $request, $id)
	{
		try {
			$student = Student::findOrFail($id);
			return json_encode([
				"status" => "ok",
				"data" => [
					"student" => new StudentMore($student),
					"resume" => $student->getResume()
				]
			]);
		} catch (\Throwable $th) {
			return json_encode([
				"status" => "Bad request",
				"error" => $th
			]);
		}
	}


	public function getOrgs(Request $request)
	{
		try {
			return json_encode([
				"status" => "ok",
				"data" => Organization::all()
			]);
		} catch (\Throwable $th) {
			return json_encode([
				"status" => "Bad request",
				"error" => $th
			]);
		}
	}

	public function getOrg(Request $request, $id)
	{
		try {
			return json_encode([
				"status" => "ok",
				"data" => new OrganizationMore(Organization::findOrFail($id))
			]);
		} catch (\Throwable $th) {
			return json_encode([
				"status" => "Bad request",
				"error" => $th
			]);
		}
	}

	public function getOrgVacancies(Request $request, $id)
	{
		try {
			return json_encode([
				"status" => "ok",
				"data" => Vacancy::where('user_id', Organization::findOrFail($id)->getUser()->id)->get()
			]);
		} catch (\Throwable $th) {
			return json_encode([
				"status" => "Bad request",
				"error" => $th
			]);
		}
	}

	public function getOrgsByRegion(Request $request)
	{
		try {
			$regionId = $request->input("regionId");
			return json_encode([
				"status" => "ok",
				"region" => Region::find($regionId)->name,
				"data" => Organization::select('organizations.*')
				->join('users', 'users.details', '=', 'organizations.id')
				->where('users.role', 'organization')
				->where('users.region_id', $regionId)->get()
			]);
		} catch (\Throwable $th) {
			return json_encode([
				"status" => "Bad request",
				"error" => $th
			]);
		}
	}


	public function getVacancies(Request $request)
	{
		try {
			return json_encode([
				"status" => "ok",
				"data" => VacancyLess::collection(Vacancy::all())
			]);
		} catch (\Throwable $th) {
			return json_encode([
				"status" => "Bad request",
				"error" => $th
			]);
		}
	}

	public function getVacancy(Request $request, $id)
	{
		try {
			return json_encode([
				"status" => "ok",
				"data" => Vacancy::findOrFail($id)
			]);
		} catch (\Throwable $th) {
			return json_encode([
				"status" => "Bad request",
				"error" => $th
			]);
		}
	}

	public function searchVacancy(Request $request){
		$q = $request->has('q') ? $request->q : '';
		$res = Vacancy::select('vacancies.*')
				->join('users', 'users.id', '=', 'vacancies.user_id')
				->where('vacancies.is_active', 1)
				->where(function($query) use($q){
						$query->where('vacancies.position', 'like', '%'.$q.'%')
						->orWhere('vacancies.duties', 'like', '%'.$q.'%')
						->orWhere('vacancies.additional_info', 'like', '%'.$q.'%');
				});
		if($request->region_id != 0 && $request->region_id != null){
				$res->where('users.region_id', $request->region_id);
		}
		if($request->sFrom > 0 && $request->sFrom != null){
				$res->where('vacancies.salary_from', '>', $request->sFrom);
		}else if($request->sTo > 0 && $request->sTo != null){
				$res->where('vacancies.salary_to', '<', $request->sTo);
		}
		$result = $res->get();
		return json_encode([
			"status"=>"ok",
			"total"=> count($result),
			"data"=> VacancyLess::collection($result)
		]);
	}


	public function getResumes(Request $request)
	{
		try {
			return json_encode([
				"status" => "ok",
				"data" => ResumeLess::collection(Resume::all())
			]);
		} catch (\Throwable $th) {
			return json_encode([
				"status" => "Bad request",
				"error" => $th
			]);
		}
	}

	public function getResume(Request $request, $id)
	{
		try {
			$resume = Resume::findOrFail($id);
			return json_encode([
				"status" => "ok",
				"data" => [
					"student" => new StudentMore($resume->getUser()->getDetails()),
					"resume" => $resume
				]
			]);
		} catch (\Throwable $th) {
			return json_encode([
				"status" => "Bad request",
				"error" => $th
			]);
		}
	}

	public function searchResume(Request $request){
		$q = $request->has('q') ? $request->q : '';
		$res = Resume::select('resumes.*')
				->join('users', 'users.id', '=', 'resumes.user_id')
				->where(function($query) use($q){
						$query->where('resumes.position', 'like', '%'.$q.'%');
				});
		if($request->region_id != 0 && $request->region_id != null){
				$res->where('users.region_id', $request->region_id);
		}
		if($request->sFrom > 0 && $request->sFrom != null){
				$res->where('resumes.salary_from', '>', $request->sFrom);
		}else if($request->sTo > 0 && $request->sTo != null){
				$res->where('resumes.salary_to', '<', $request->sTo);
		}
		$result = $res->get();
		return json_encode([
			"status"=>"ok",
			"total"=> count($result),
			"data"=> ResumeLess::collection($result)
		]);
	}
}
