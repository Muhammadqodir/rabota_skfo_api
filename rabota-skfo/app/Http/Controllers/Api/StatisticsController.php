<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
	public function getStat(){
		
		return {
			'status' => 'ok',
			'data' => ''
		}
	}
}
