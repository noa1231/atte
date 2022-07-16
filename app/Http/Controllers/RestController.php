<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rest;
use App\Models\Work;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RestController extends Controller
{
    //休憩開始
    public function start()
    {
        $id = Auth::id();

        $dt = new Carbon();
        $time = $dt->toTimeString();
        $date = $dt->toDateString();
        //ログインidとworkのidが結びつく一番新しい日付
        $attendance = Work::where('user_id', $id)->where('date', $date)->first();

        $startTime = [
            'work_id' => $attendance->id,
            'start_rest' => $time,
        ];

        Rest::create($startTime);

        return redirect('/');
    }

    //休憩終了
    public function stop()
    {
        $id = Auth::id();

        $dt = new Carbon();
        $time = $dt->toTimeString();
        $date = $dt->toDateString();

        $attendance = Work::where('user_id', $id)->where('date', $date)->first();
        $attendance_id = $attendance->id;

        Rest::where('work_id',$attendance_id)->latest()->first()->update(['end_rest' => $time]);
        
        return redirect('/');
    }
}
