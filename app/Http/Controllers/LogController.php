<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogController extends Controller
{
    public function sendLog($description)
    {
        $dateTimeController = new DateTimeController();
        $date = $dateTimeController->getDateTime(new Request());
        $user = session()->get('user_name');
        $logID = $this->logIDGenerator();
        $data = array(
            'user' => $user,
            'date_added' => $date,
            'log_id' => $logID,
            'description' => $description
        );
        DB::table('m_logs')->insert($data);
    }

    public function logIDGenerator()
    {
        $rowCount = DB::table('m_logs')->count();

        $rowCount++;
        $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
        $candidateId = "ID-Logs-" . $formattedRowCount;

        $existingSuppllier = DB::table('m_logs')->where('log_id', $candidateId)->first();

        while ($existingSuppllier) {
            $rowCount++;
            $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
            $candidateId = "ID-Logs-" . $formattedRowCount;
            $existingSuppllier = DB::table('m_logs')->where('log_id', $candidateId)->first();
        }

        return $candidateId;
    }

    public function updateLogTable()
    {
        $logs = DB::table('m_logs')->get();
        return view('logs', ['logs' => $logs]);
    }
}
