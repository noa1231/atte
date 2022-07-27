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
        
        $dt = new Carbon();
        $today = $dt->toDateString();

        $id = Auth::id();
        
        $users = Work::where('user_id',$id)->where('date', $today)->first();
        // dd($users);
        if (empty($users)) {
            return view('index');
        }

        $rests = $users->rests->whereNull("end_rest")->first();

        if ($users->end_work) {
            return view('index')->with([
                "is_attendance_start" => true,
                "is_attendance_end" => true,
            ]);
        }

        if ($users->start_work) {
            if (isset($rests)) {
                return view('index')->with([
                    "is_rest" => true,
                    "is_attendance_start" => true,
                ]);
            } else {
                return view('index')->with([
                    "is_rest" => false,
                    "is_attendance_start" => true,
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
        } else {
            $date = $dt->subDays(-$num);
        }

        $items = Work::where('date',$dt)->paginate(5);
        
        foreach($items as $index => $item){   
            $rests = $item->rests;
            $sum = 0;
            foreach($rests as $rest){
                $startTime = $rest->start_rest;
                $start_dt = new Carbon($startTime);
                $endTime = $rest->end_rest;
                $end_dt = new Carbon($endTime);
                $diff_seconds = $start_dt->diffInSeconds($end_dt);
                $sum = $sum + $diff_seconds;
            }
            $start_at = new Carbon($item->start_work);
            $end_at = new Carbon($item->end_work);

            $diff_start_end = $start_at->diffInSeconds($end_at);
            $diff_work = $diff_start_end - $sum;

            $res_hours = floor($sum / 3600);
            $res_minutes = floor(($sum / 60) % 60);
            $res_seconds = $sum % 60;

            $work_hours = floor($diff_work / 3600);
            $work_minutes = floor(($diff_work / 60) % 60);
            $work_seconds = $diff_work % 60;

            $time_dt = Carbon::createFromTime($res_hours, $res_minutes, $res_seconds);

            $time_work = Carbon::createFromTime($work_hours, $work_minutes, $work_seconds);

            $items[$index]->rest_sum = $time_dt->toTimeString();
            $items[$index]->work_time = $time_work->toTimeString();
        }
    
    //dd($items);
        return view('attendance',compact('items','date', 'num'));
        //return $items;
    }
}
