<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;

class TaskController extends Controller
{
    
    public function index()
    {
        $tasks = Task::where(
            'user_id',
            session('user')['id']
        )->get();

        return view(
            'all-task',
            compact('tasks')
        );
    }

    public function search(Request $request)
    {
        $query = $request->search;

        $tasks = Task::where(
            'user_id',
            session('user')['id']
        )
        ->where(
            'task_name',
            'LIKE',
            "%{$query}%"
        )
        ->get();

        return response()->json($tasks);
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

        return redirect()
            ->route('all-task')
            ->with(
                'success',
                'Tugas berhasil ditambah!'
            );
    }

 
    public function dashboard()
    {
        $user = session('user');

        $firstName =
            $user['first_name']
            ?? 'Guest';

        $tasks = Task::where(
            'user_id',
            session('user')['id']
        )->get();

        $totalTask =
            $tasks->count();

        $completedCount =
            $tasks
            ->where(
                'status',
                'Done'
            )
            ->count();

        $inProgressCount =
            $tasks
            ->where(
                'status',
                '!=',
                'Done'
            )
            ->count();

        return view(
            'dashboard',
            compact(
                'firstName',
                'tasks',
                'totalTask',
                'completedCount',
                'inProgressCount'
            )
        );
    }

    
    public function detail($id)
    {
        $task = Task::where(
            'id',
            $id
        )
        ->where(
            'user_id',
            session('user')['id']
        )
        ->firstOrFail();

        return view(
            'tasks.detail',
            compact('task')
        );
    }

    public function updateStatus($id)
    {
        $task = Task::where(
            'id',
            $id
        )
        ->where(
            'user_id',
            session('user')['id']
        )
        ->first();

        if ($task) {

            $task->update([
                'status' => 'Done'
            ]);

            return back()
                ->with(
                    'success',
                    'Task selesai!'
                );
        }

        return back()
            ->with(
                'error',
                'Task tidak ditemukan'
            );
    }
}