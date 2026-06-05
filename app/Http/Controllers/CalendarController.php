<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Task;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        // LOGIN CHECK
        if (!session()->has('user')) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        // BULAN AKTIF
        if ($request->has('month')) {

            $date = Carbon::createFromFormat(
                'Y-m',
                $request->month
            );
        } else {

            $date = now();
        }

        // VIEW (month/week)
        $view = $request->get('view', 'month');

        $month = $date->month;
        $year = $date->year;

        // TOTAL HARI BULAN
        $daysInMonth = $date->daysInMonth;

        // POSISI HARI PERTAMA
        $startDay = $date
            ->copy()
            ->startOfMonth()
            ->dayOfWeekIso - 1;

        // TOTAL CELL KALENDER
        $totalCells = ceil(
            ($daysInMonth + $startDay) / 7
        ) * 7;


        $tasks = Task::where(
            'user_id',
            session('user')['id']
        )->get();

        $events = [];

        foreach ($tasks as $task) {

            $events[$task->due_date][] = [
                'id' => $task->id,
                'title' => $task->task_name,
                'course' => $task->course,
                'time' => $task->time,
            ];
        }


        // DATA WEEK VIEW
        $weeklyEvents = [];

        foreach ($events ?? [] as $dateKey => $dayEvents) {

            $weekNumber = Carbon::parse($dateKey)
                ->weekOfMonth;

            foreach ($dayEvents as $event) {

                $weeklyEvents[$weekNumber][] = [
                    'date' => $dateKey,
                    'event' => $event
                ];
            }
        }

        ksort($weeklyEvents);

        return view(
            'calendar',
            compact(
                'date',
                'view',
                'daysInMonth',
                'startDay',
                'totalCells',
                'events',
                'weeklyEvents',
                'month',
                'year'
            )
        );
    }

    private function translateDate($dateString)
    {
        $months = [
            'januari' => 'january',
            'februari' => 'february',
            'maret' => 'march',
            'april' => 'april',
            'mei' => 'may',
            'juni' => 'june',
            'juli' => 'july',
            'agustus' => 'august',
            'september' => 'september',
            'oktober' => 'october',
            'november' => 'november',
            'desember' => 'december'
        ];

        return strtr(
            strtolower($dateString),
            $months
        );
    }
}
