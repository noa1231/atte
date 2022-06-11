<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Work;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function start()
    {
        Work::create([
            'start_work' => Carbon::now(),
        ]);
        return redirect('/');
    }
}
