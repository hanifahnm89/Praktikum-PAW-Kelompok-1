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

    $tasks = Storage::exists($path)
        ? json_decode(Storage::get($path), true)
        : [];

    $newTask = [
        'id' => uniqid(),

        // IMPORTANT
        'title' => $request->task_name,
        'course' => $request->course,
        'date' => $request->deadline,

        // tambahan
        'time' => $request->time ?? '23:59',
        'priority' => $request->priority ?? 'Medium',
        'status' => $request->status ?? 'Not Started',
    ];

    $tasks[] = $newTask;

    Storage::put(
        $path,
        json_encode($tasks, JSON_PRETTY_PRINT)
    );

    return redirect()
        ->route('all-task')
        ->with('success', 'Tugas berhasil ditambah!');
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

    public function updateStatus($id)
{
    $path = 'tasks.json';

    $tasks = Storage::exists($path)
        ? json_decode(Storage::get($path), true)
        : [];

    if (!is_array($tasks)) {
        $tasks = [];
    }

    foreach ($tasks as &$task) {

        if (isset($task['id']) && $task['id'] == $id) {

            $task['status'] = 'Done';

            break;
        }
    }

    Storage::put(
        $path,
        json_encode($tasks, JSON_PRETTY_PRINT)
    );

    // BALIK KE HALAMAN SEBELUMNYA
    return back()->with(
        'success',
        'Task berhasil diselesaikan!'
    );
}

    public function detail($id)
{
    $path = 'tasks.json';

    $tasks = Storage::exists($path)
        ? json_decode(Storage::get($path), true)
        : [];

    $task = collect($tasks)->firstWhere('id', $id);

    return view('tasks.detail', compact('task'));
}
}