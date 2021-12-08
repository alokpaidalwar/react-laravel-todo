<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the all the tasks.
     */
    public function index(){
        $tasks = Task::where('user_id', auth()->user()->id)
                        ->orderBy('created_at')
                        ->get();

        return $tasks->toJson();
    }

    /**
     * Add new task
     */
    public function store(Request $request){
        $validatedData = $request->validate([
          'title' => 'required',
        ]);

        Task::create([
          'user_id' => auth()->user()->id,
          'title' => $validatedData['title'],
        ]);

        return response()->json('Task created!');
    }

    /**
     * Delete the task by id.
     */
    public function delete($id){
        $task = Task::findOrFail($id);
        if($task->user_id == auth()->user()->id){
            $task->delete();
            return response()->json('Task Deleted!');
        }else{
            return response()->json('Not authorized!');
        } 
    }

}
