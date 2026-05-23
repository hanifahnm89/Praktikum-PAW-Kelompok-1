<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        // LOGIN CHECK
        if (!session()->has('user')) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        if ($request->has('month')) {

            $date = Carbon::createFromFormat('Y-m', $request->month);
        } else {

            $date = now();
        }

        $month = $date->month;
        $year = $date->year;

        // TOTAL HARI DALAM BULAN
        $daysInMonth = $date->daysInMonth;

        // POSISI HARI PERTAMA
        $startDay = $date->copy()->startOfMonth()->dayOfWeekIso - 1;

        // TOTAL CELL KALENDER
        $totalCells = ceil(($daysInMonth + $startDay) / 7) * 7;

        // AMBIL TASK JSON
        $path = 'tasks.json';

        $allTasks = Storage::exists($path)
            ? json_decode(Storage::get($path), true)
            : [];

        // FILTER EVENT
        $events = collect($allTasks)
            ->filter(function ($task) use ($month, $year) {

                if (!isset($task['due'])) return false;

                try {

                    $dateString = $this->translateDate($task['due']);

                    $taskDate = Carbon::parse($dateString);

                    return $taskDate->month == $month
                        && $taskDate->year == $year;
                } catch (\Exception $e) {

                    return false;
                }
            })
            ->groupBy(function ($task) {

                try {

                    $dateString = $this->translateDate($task['due']);

                    return Carbon::parse($dateString)
                        ->format('Y-m-d');
                } catch (\Exception $e) {

                    return 'invalid-date';
                }
            });

        return view('calendar', compact(
            'date',
            'daysInMonth',
            'startDay',
            'totalCells',
            'events',
            'month',
            'year'
        ));
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

        return strtr(strtolower($dateString), $months);
    }
}
