<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Work;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    //勤怠の登録処理ページ表示

    public function index()
    {
        return view('index');
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
        Work::where('user_id',$id)->update(['end_work' => $time]);
        
        return redirect('/');
    }

    //勤怠の表示

    public function show()
    {
        $items = User::all();
        
        return view('attendance',['items' => $items]);
    }
}
