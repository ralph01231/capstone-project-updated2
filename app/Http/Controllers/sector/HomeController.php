<?php

namespace App\Http\Controllers\sector;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;

class HomeController extends Controller
{
    public function create(){


        $totalFire = Report::where('emergency_type','Fire')->count();
        $totalMedic = Report::where('emergency_type','Medical')->count();
        $totalAccident = Report::where('emergency_type','Accident')->count();
        $totalCrime = Report::where('emergency_type','Crime')->count();

        return view('sector.dashboard',compact( 'totalFire','totalMedic', 'totalAccident', 'totalCrime') );

    }
}
