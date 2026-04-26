<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Event;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->month ?? now()->month;
        $year = $request->year ?? now()->year;

        $date = Carbon::create($year, $month, 1);
        $daysInMonth = $date->daysInMonth;

        $events = Event::whereMonth('date', $month)
            ->whereYear('date', $year)
            ->get()
            ->groupBy('date');

        return view('calendar', compact('date', 'daysInMonth', 'events'));
    }
}
