<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', session('user')['id'])->get();
        return view('all-task', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'task_name' => 'required',
            'course' => 'required',
            'due_date' => 'required|date',
        ]);

        Task::create([
            'user_id' => session('user')['id'],
            'task_name' => $request->task_name,
            'course' => $request->course,
            'due_date' => $request->due_date,
            'status' => 'Not Started'
        ]);

        return redirect()->route('all-task')->with('success', 'Tugas berhasil ditambah!');
    }

    public function dashboard()
    {
        $user = session('user');
        
        $firstName = $user['first_name'] ?? 'Ifka';

        $tasks = Task::where('user_id', session('user')['id'])->get();

        $totalTask = $tasks->count();
        $completedCount = $tasks->where('status', 'Done')->count();
        $inProgressCount = $tasks->where('status', '!=', 'Done')->count();

        return view('dashboard', [
            'firstName' => $firstName,
            'tasks' => $tasks,
            'totalTask' => $totalTask,
            'completedCount' => $completedCount,
            'inProgressCount' => $inProgressCount 
        ]);
    }

    public function detail($id)
    {
        $task = Task::where('id', $id)
            ->where('user_id', session('user.id'))
            ->firstOrFail();

        return view('tasks.detail', compact('task'));
    }

    public function updateStatus($id) 
    {
        $task = Task::where('id', $id) ->where('user_id', session('user')['id']);

        if ($task) {
            $task->update(['status' => 'Done']);
            return back()->with('success', 'Hore! Task berhasil diselesaikan.');
        }

        return back()->with('error', 'Tugas tidak ditemukan.');
    }
}