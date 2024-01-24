<?php
namespace App\Http\Controllers\Dedusting;

use App\Http\Controllers\Controller;

class DedustingController extends Controller
{
  public function filtrationArea() 
  {
    return view('dedusting.filtration-area');
  }
}