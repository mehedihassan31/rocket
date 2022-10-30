<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class LaunchTimeController extends Controller
{
    function getData(){

        $current = Carbon::now();

        return  $current;

    }
    function estTimeCalc(){

        $current = Carbon::now();

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
            $t1=(2*$data['va'])/$data['a'];
            $t2=$data['s']/$data['vs'];

            $t[$key]=Carbon::now()->addHours(6)->addMinute(($t1+$t2)/$m)->format('d/m/Y H:i:s');

        }

        return $t;



    }
}
