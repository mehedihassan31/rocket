<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaunchLog extends Model
{
    use HasFactory;
    protected $table = 'launch_log';
    protected $fillable = [
        'roket_no',
        'launch_time',
        'come_back_time',
    ];
    public $timestamps = true;
}
