<?php

namespace App\Http\Controllers;

use App\Enums\TaskStatusEnum;
use App\Models\Task;
use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Controllers\TaskController;
use App\Http\Requests\UpdateTodoRequest;

class TodoController extends Controller
{
    public function update($id, Request $request)
    {
        Todo::find($id)
            ->update($request->validate([
                'name' => 'required',
                'description' => 'required'
            ]));
        return back();
    }

    public function updateState($id)
    {
        $todo = Todo::find($id);
        $todo->update([
            'done' => $todo->done == 1 ? 0 : 1
        ]);

        $todosCount = Todo::where('task_id', $todo->task_id)->count();
        $todosCheckedCount = Todo::where('task_id', $todo->task_id)->where('done', 1)->count();

        Task::find($todo->task_id)->update([
                'state' => (
                    ($todosCheckedCount == $todosCount)
                        ? TaskStatusEnum::COMPLETED : (($todosCheckedCount == 0)
                        ? TaskStatusEnum::WAITING : TaskStatusEnum::PROCESSING)
                    )
                ]);

        return back();
    }

    public function destroy($id)
    {
        Todo::find($id)->delete();
        return back();
    }
}
