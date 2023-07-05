<?php

namespace App\Http\Controllers;

use App\Models\SwitchUtil;
// use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Illuminate\Support\Str;
use App\Charts\SampleChart;
use App\Models\Distance;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index() {
        $role = auth()->user()->role;
        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else if ($role === 'user') {
            dd('See DashboardController, you are a user');
        }
    }

    public function admin() {
        $switch = SwitchUtil::first();
        $distance = Distance::latest()->take(30)->get();
        $count = count($distance);
        foreach($distance as $key => $dis) {
            $y[$key] = $dis->length;
            $x[$key] = Carbon::parse($dis->created_at)->format("d M Y H:i:s");
        }

        $x = array_reverse($x);
        $y = array_reverse($y);

        $chart = new SampleChart;
        $chart->labels($x);
        $chart->dataset('Length Dataset', 'line', $y);

        return view('admin.dashboard.index', compact('switch', 'chart'));
    }

    public function image() {
        dd(Str::uuid());
    }
}
