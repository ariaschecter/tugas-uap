<?php

namespace App\Http\Controllers;

use App\Models\Distance;
use App\Models\SwitchUtil;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function distance(Request $request) {
        $length = $request->distance;
        $switch = SwitchUtil::first();
        if ($length < 50) {
            $switch->update(['switch' => 1]);
        } else {
            $switch->update(['switch' => 0]);
        }

        $distance = Distance::create([
            'length' => $length
        ]);
        return response()->json([
            'distance' => $distance
        ]);
    }

    public function switch() {
        $switch = SwitchUtil::first();
        return response()->json([
            'switch' => $switch->switch
        ]);
    }
}
