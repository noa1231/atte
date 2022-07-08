<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Work;
use App\Models\User;
use App\Models\Rest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    //勤怠の登録処理ページ表示

    public function index()
    {
        // $users = Work::with(['user'])->latest()->first();
        // $rests = Rest::with(['work'])->latest()->first();
        $today = Carbon::today();
        // $users = Work::whereDate('created_at', $today)->latest()->get();
        // $rests = Rest::whereDate('created_at', $today)->latest()->get();
        $users = Work::whereDate('created_at', $today)->latest()->first();
        $rests = Rest::whereDate('created_at', $today)->latest()->first();
    
        //dd($users);
        return view('index', compact('users', 'rests'));
        // return $users;
    }

    //勤務開始

    public function start()
    {
        $id = Auth::id();

        $dt = new Carbon();
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        
        $startTime = [
            'user_id' => $id,
            'date'  => $date,
            'start_work' => $time,
        ];

        Work::create($startTime);

        return redirect('/');
    }

    //勤務終了

    public function stop()
    {
        $id = Auth::id();

        $dt = new Carbon();
        $time = $dt->toTimeString();
        Work::where('user_id',$id)->latest()->first()->update(['end_work' => $time]);
        return redirect('/');
    }

    //勤怠の表示

    public function show()
    {
        $items = User::all();
        
        $startRests = Rest::with(['work'])->get();
        $endRests = Rest::with(['work'])->get();

        //dd($startRests);
        return view('attendance',[
            'items' => $items,
            'startRests' => $startRests,
            'endRests' => $endRests
    ]);
    }
}
