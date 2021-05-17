<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Effort;
use DB;

class EffortGraphController extends Controller
{
  public function index(){
  	$apiEffortCreate = DB::table('efforts')
  		->select('created_at', 'effort_time')
  		->whereBetween('efforts.created_at', [now()->startOfMonth()->format('Y-m-d'), now()->endOfMonth()->format('Y-m-d')])
  		->limit(7)
  		->orderby('created_at', 'desc')
  		->pluck('created_at')
  		->all();

  	$apiEffortTime = DB::table('efforts')
  		->select('created_at', 'effort_time')
  		->whereBetween('efforts.created_at', [now()->startOfMonth()->format('Y-m-d'), now()->endOfMonth()->format('Y-m-d')])
  		->limit(7)
  		->orderby('created_at', 'desc')
  		->pluck('effort_time')
  		->all();  		

  	return [
  		'apiEffortCreate' => $apiEffortCreate, 
  		'apiEffortTime' => $apiEffortTime
  	];
  }
}
