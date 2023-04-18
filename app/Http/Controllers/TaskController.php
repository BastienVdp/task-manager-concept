<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\Todo;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Enums\TaskStatusEnum;
use App\Enums\TaskPriorityEnum;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTaskRequest;
use Illuminate\Support\Facades\Redirect;


class TaskController extends Controller
{
    public function index()
    {
        return Inertia::render('Tasks/Index', [
            'status' => TaskStatusEnum::array(),
            'todo' => Task::where('user_id', Auth::user()->id)
                            ->where('state', TaskStatusEnum::WAITING)
                            ->where('deadline', '>=',Carbon::today()->format('Y-m-d'))
                            ->withCount('todos')
                            ->withCount('todosCompleted')
                            ->orderBy('deadline', 'ASC')
                            ->get(),
            'doing' => Task::where('user_id', Auth::user()->id)
                            ->where('state', TaskStatusEnum::PROCESSING)
                            ->where('deadline', '>=',Carbon::today()->format('Y-m-d'))
                            ->withCount('todos')
                            ->withCount('todosCompleted')
                            ->orderBy('deadline', 'ASC')
                            ->get(),
            'done' => Task::where('user_id', Auth::user()->id)
                            ->where('state', TaskStatusEnum::COMPLETED)
                            ->where('deadline', '>=',Carbon::today()->format('Y-m-d'))
                            ->withCount('todos')
                            ->withCount('todosCompleted')
                            ->orderBy('deadline', 'ASC')
                            ->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Tasks/Create', [
            'priority' => TaskPriorityEnum::values(),
        ]);
    }

    public function store(StoreTaskRequest $request)
    {
        $task = Auth::user()->tasks()->create(
            $request->safe()->merge([
                'state' => TaskStatusEnum::WAITING
            ])->except(['todos'])
        );

        foreach($request->only(['todos']) as $todos) {
            foreach($todos as $todo) {
                $task->todos()->create($todo);
            }
        }

        return Redirect::route('dashboard.index');
    }

    public function show($id)
    {
        return Inertia::render('Tasks/Show', [

            'tasks' => Task::where('user_id', Auth::user()->id)
                            ->where('id', $id)
                            ->withCount('todos')
                            ->get(),
            'todos' => Todo::where('task_id', $id)
                            ->get()
        ]);
    }

    public function update($id, Request $request)
    {
        Task::find($id)
            ->update($request->validate([
                'title' => 'required',
                'description' => 'required'
            ]));

        return back();
    }

    public function updateLiked($id)
    {
        $task = Task::find($id);
        $task->update([
            'liked' => $task->liked == 1 ? 0 : 1
        ]);
        return back();
    }

    public function destroy($id)
    {
        Task::find($id)->delete();
        return back();
    }
}
