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

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', [
            'filters' => TaskPriorityEnum::values(),
            'status' => TaskStatusEnum::array(),
            'completedCount' => Task::where('user_id', Auth::user()->id)
                            ->whereHas('todos', function($query) {
                                $query->where('done', '1');
                            })->count(),
            'taskCount' => Task::where('user_id', Auth::user()->id)
                            ->where('deadline', '>=',Carbon::today()->format('Y-m-d'))
                            ->count(),
            'importantCount' => Task::where('user_id', Auth::user()->id)
                            ->where('deadline', '>=',Carbon::today()->format('Y-m-d'))
                            ->where('priority', 'High')
                            ->count(),
            'tasks' => Task::where('user_id', Auth::user()->id)
                            ->where('deadline', Carbon::today()->format('Y-m-d'))
                            ->orderBy('created_at', 'DESC')
                            ->get(),
            'up_coming' => Task::where('user_id', Auth::user()->id)
                            ->where('deadline', '>', Carbon::today()->format('Y-m-d'))
                            ->orderBy('created_at', 'DESC')
                            ->get()
        ]);
    }

    public function filter(Request $request)
    {

        return Inertia::render('Dashboard', [
            'filters' => TaskPriorityEnum::values(),
            'status' => TaskStatusEnum::array(),
            'taskCount' => Task::where('user_id', Auth::user()->id)
                            ->where('deadline', '>=',Carbon::today()->format('Y-m-d'))
                            ->count(),
            'importantCount' => Task::where('user_id', Auth::user()->id)
                            ->where('deadline', '>=',Carbon::today()->format('Y-m-d'))
                            ->where('priority', 'High')
                            ->count(),
            'tasks' => Task::where('user_id', Auth::user()->id)
                            ->where('deadline', Carbon::today()->format('Y-m-d'))
                            ->where('priority', $request->priority)
                            ->orderBy('created_at', 'DESC')
                            ->get(),
            'up_coming' => Task::where('user_id', Auth::user()->id)
                            ->where('deadline', '>', Carbon::today()->format('Y-m-d'))
                            ->where('priority', $request->priority)
                            ->orderBy('created_at', 'DESC')
                            ->get()
         ]);
    }
}
