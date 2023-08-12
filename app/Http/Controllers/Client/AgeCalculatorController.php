<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DateTime;

class AgeCalculatorController extends Controller
{
    public function calculateAge(Request $request)
    {
        if ($request->has('dob') && $request->input('dob') !== '') {
            $dob = $request->input('dob');
            $bday = new DateTime($dob);
            $tday = new DateTime(date('Y-m-d'));
            
            if ($bday > $tday) {
                $ageResult = 'Not born yet';
            } else {
                $diff = $tday->diff($bday);
                
                $ageYears = $diff->y;
                $ageMonths = $diff->m;
                $ageDays = $diff->d;
                
                $yearLabel = ($ageYears == 1) ? 'year' : 'years';
                $monthLabel = ($ageMonths == 1) ? 'month' : 'months';
                $dayLabel = ($ageDays == 1) ? 'day' : 'days';
                
                $ageResult = 'Age is: ' . $ageYears . ' ' . $yearLabel . ' ' . $ageMonths . ' ' . $monthLabel . ' ' . $ageDays . ' ' . $dayLabel;
            }
        } else {
            $ageResult = null;
        }

        return view('admin.client.calculator.index', compact('ageResult'));
    }

}