<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    public function index()
    {
        $path = 'tasks.json';
        $tasks = Storage::exists($path) ? json_decode(Storage::get($path), true) : [];
        return view('all-task', compact('tasks'));
    }

    public function store(Request $request)
    {
        $path = 'tasks.json';
        $tasks = Storage::exists($path) ? json_decode(Storage::get($path), true) : [];

        $newTask = [
            'name' => $request->task_name,
            'course' => $request->course,
            'due' => $request->deadline,
            'time' => '23.59',
            'status' => 'Not Started'
        ];

        $tasks[] = $newTask; 
        Storage::put($path, json_encode($tasks, JSON_PRETTY_PRINT)); 

        return redirect()->route('all-task')->with('success', 'Tugas berhasil ditambah!');
    }

    public function dashboard(){

        $user = session('user');
        $userName = $user ? $user['name'] : 'Guest';

        $path = 'tasks.json';
        $tasks = \Storage::exists($path) ? json_decode(\Storage::get($path), true) : [];

        $totalTask = count($tasks);
        $completedCount = count(array_filter($tasks, fn($t) => $t['status'] === 'Done'));

        return view('dashboard', [
            'userName' => $userName,
            'tasks' => $tasks,
            'totalTask' => $totalTask,
            'completedCount' => $completedCount
        ]);
    }
}