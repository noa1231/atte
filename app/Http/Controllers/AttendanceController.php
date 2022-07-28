<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Work;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    //勤怠の登録処理ページ表示

    public function index()
    {
        
        $dt = new Carbon();
        $today = $dt->toDateString();

        $id = Auth::id();
        
        $users = Work::where('user_id',$id)->where('date', $today)->first();
        // dd($users);
        
        // 勤務開始前
        if (empty($users)) {
            return view('index')->with([
                "is_attendance_start" => true,
            ]);;
        }

        $rests = $users->rests->whereNull("end_rest")->first();

        // 勤務終了を押した後
        if ($users->end_work) {
            return view('index');
        }

        // 勤務開始を押した後
        if ($users->start_work) {
            // 休憩してるとき
            if (isset($rests)) {
                return view('index')->with([
                    "is_rest_end" => true,
                ]);
            // 休憩していないとき
            } else {
                return view('index')->with([
                    "is_attendance_end" => true,
                    "is_rest_start" => true,
                ]);
            }
        }
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

    public function show(Request $request)
    {
        $dt = Carbon::today();
        $num = (int)$request->num;

        if ($num == 0) {
            $date = $dt;
        } elseif ($num > 0) {
            $date = $dt->addDays($num);
        } else{
            $date = $dt->subDays(-$num);
        }

        $items = Work::where('date',$dt)->paginate(5);
        
        $items = Work::getSumTime($items);
    
    //dd($items);
        return view('attendance',compact('items','date', 'num'));
        //return $items;
    }
}
