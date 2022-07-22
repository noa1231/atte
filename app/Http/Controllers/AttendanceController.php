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
        
        $today = Carbon::today();

        $id = Auth::id();
        
        $users = Work::whereDate('created_at', $today)->where('user_id',$id)->latest()->first();
        if (empty($users)) {
            return view('index');
        }else{
        $rests = $users->rests->first();

        // dd($rests);
        return view('index', compact('users', 'rests'));
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

        // $pages = Work::Paginate(5);

        $items = Work::with('user')->where('date',$dt)->get();
        //$items = Work::where('date',$dt)->get();
        //$items = Work::with('rests')->get('created_at',$days)->first();

        // foreach($startRests as $startRest){
        //     $restTimes = $startRest;
        // }

        //dd($tests);
        return view('attendance',compact('items','date', 'num'));
        //return $items;
    }
}
