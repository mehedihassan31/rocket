<?php

namespace App\Http\Controllers;
use App\Models\LaunchLog;

use Illuminate\Http\Request;
use Carbon\Carbon;

class LaunchTimeController extends Controller
{
    function getData(){

        LaunchLog::all();

        return  LaunchLog::all();

    }
    function estTimeCalc(Request $request){

        // return $lunchtime= Carbon::parse($request->luanchtime);

        $rocketA=[
            'va'=> 2.77*1000,
            'a'=>50,
            'vs'=>3.56,
            's'=>408,
        ];

        $rocketB=[
            'va'=>3.80*1000,
            'a'=>50,
            'vs'=>3.00,
            's'=>408,
        ];
        $rocketC=[
            'va'=>3.0*1000,
            'a'=>50,
            'vs'=>4.00,
            's'=>408,
        ];

        $rocket=[
            'rocketA'=>$rocketA,
            'rocketB'=>$rocketB,
            'rocketC'=>$rocketC,
        ];

        foreach($rocket as $key=>$data){
            $m=60;
            $h=60*60;
            $t1=(2*$data['va'])/$data['a'];
            $t2=$data['s']/$data['vs'];
            $to=$t1+$t2;

            if($to>=60){
                $t=Carbon::parse($request->luanchtime)->addHours(6)->addMinutes(($t1+$t2)/$m)->addSeconds(($t1+$t2)%$m);
                $res[$key]=$t->format('d/m/Y H:i:s');
            }elseif($to<60){
                $t=Carbon::parse($request->luanchtime)->addHours(6)->addSeconds($t1+$t2);
                $res[$key]=$t->format('d/m/Y H:i:s');
            }else{
                $t=Carbon::parse($request->luanchtime)->addHours(6)->addSeconds(($t1+$t2)/$h)->addMinutes(($t1+$t2)%$h);
                $res[$key]=$t->format('d/m/Y H:i:s');
                
            }

            $addInDB=LaunchLog::create([
                'roket_no'=>$key,
                'launch_time'=>$request->luanchtime,
                'come_back_time'=>$t,
            ]);

        }

        return $res;

    }
}
