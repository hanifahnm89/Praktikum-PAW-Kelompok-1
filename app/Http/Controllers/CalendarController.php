<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        // 1. PROTEKSI LOGIN MANUAL (Syarat Asdos)
        if (!session()->has('user')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // 2. Tentukan Bulan dan Tahun dari Request atau Default sekarang
        $month = $request->month ?? now()->month;
        $year = $request->year ?? now()->year;

        // Inisialisasi Carbon untuk navigasi kalender
        $date = Carbon::create($year, $month, 1);
        $daysInMonth = $date->daysInMonth;

        // 3. BACA DATA DARI JSON (Pengganti Database)
        $path = 'tasks.json';
        $allTasks = Storage::exists($path) ? json_decode(Storage::get($path), true) : [];

        // 4. FILTER DATA BERDASARKAN BULAN & TAHUN (Versi Anti-Error)
        $events = collect($allTasks)->filter(function ($task) use ($month, $year) {
            if (!isset($task['due'])) return false;

            try {
                // Konversi bulan Indonesia ke Inggris agar Carbon paham
                $dateString = $this->translateDate($task['due']);
                $taskDate = Carbon::parse($dateString);
                
                return $taskDate->month == $month && $taskDate->year == $year;
            } catch (\Exception $e) {
                return false; // Skip data jika format tanggal rusak
            }
        })->groupBy(function($task) {
            try {
                $dateString = $this->translateDate($task['due']);
                return Carbon::parse($dateString)->format('Y-m-d');
            } catch (\Exception $e) {
                return 'invalid-date';
            }
        });

        return view('calendar', compact('date', 'daysInMonth', 'events', 'month', 'year'));
    }

    /**
     * Fungsi pembantu untuk menerjemahkan nama bulan Indonesia ke Inggris
     */
    private function translateDate($dateString)
    {
        $months = [
            'januari' => 'january', 'februari' => 'february', 'maret' => 'march',
            'april' => 'april', 'mei' => 'may', 'juni' => 'june',
            'juli' => 'july', 'agustus' => 'august', 'september' => 'september',
            'oktober' => 'october', 'november' => 'november', 'desember' => 'december'
        ];

        return strtr(strtolower($dateString), $months);
    }
}