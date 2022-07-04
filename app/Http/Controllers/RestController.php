<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rest;
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

        $startTime = [
            'work_id' => $id,
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
        Rest::where('work_id',$id)->latest()->first()->update(['end_rest' => $time]);
        
        return redirect('/');
    }
}
