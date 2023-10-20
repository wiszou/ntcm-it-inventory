<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
date_default_timezone_set('Asia/Manila');

class DateTimeController extends Controller
{
    public function GetDateTime(Request $request)
    {
        $date = Carbon::now();
        $formatedDate = $date->format('Y-m-d H:i:s');
        return $formatedDate;
    }
}
?>
