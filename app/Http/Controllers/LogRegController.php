<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;


class LogRegController extends Controller
{
    public function registerUser(Request $request)
    {
        $dateTimeController = new DateTimeController();
        $username = $request->input('username');
        $password = $request->input('password');

        $hashedPassword = Hash::make($password);

        $uniqueId = Str::random(20);
        $duplicateCheck = DB::table('m_users')
            ->where('userID', $uniqueId)
            ->count();

        if ($duplicateCheck > 0) {
            $uniqueId = Str::random(20);
        } else {

                $currentDate = $dateTimeController->getDateTime(new Request());
                $userData = array(
                    'username' => $username,
                    'password' => $hashedPassword,
                    'userID' => $uniqueId,
                    'user_created' => "admin",
                    'user_change' => 'admin',
                    'deleted' => 'false',
                    'date_created' => $currentDate,
                    'date_change' => $currentDate
                );

                DB::table('m_users')->insert($userData);
                return response()->json(['message' => 'success'], 200);
        }
    }

    public function loginUser(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $checkbox = $request->input('remember');
        $user = DB::table('m_users')->where('username', $username)->first();
        if ($user) {
            if (Hash::check($password, $user->password)) {
                Session::put('user_id', $user->userID);
                Session::put('user_name', $user->username);
                return response()->json(['success' => true, 'message' => 'Log in successfully.']);
            } else {
                return response()->json(['success' => false, 'message' => 'Wrong username or password.']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Wrong username or password.']);
        }
    }

    public function logOut()
    {
        Session::forget('user_id');
        Session::forget('user_name');
        return redirect()->route('welcome');
    }
}
