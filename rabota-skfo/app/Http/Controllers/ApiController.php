<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\University;

class ApiController extends Controller
{
	public function getUnivers(){
		return University::all();
	}
}
