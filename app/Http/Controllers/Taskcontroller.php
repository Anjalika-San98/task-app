<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Task;

class Taskcontroller extends Controller
{

    /**
     * @return Application|Factory|View
     */

    public function index(){
        $tasks=Task::paginate(10);
        return view('tasks',compact('tasks'));
    }

    public function store(Request $request){

        if (isset($request->task_id)){
            $id=$request->task_id;
            $task=$request->task;
            $data=Task::find($id);
            $data->task=$task;
            $data->save();
            $datas=Task::paginate(10);
            return view('tasks')->with('tasks',$datas);
        }else{
            $task=new Task;
            $this->validate($request,[
                'task'=>'required|max:100|min:5'
            ]);

            $task->task=$request->task;
            $task->save();

            $data=Task::paginate(10);
            //dd($data);

            return view('tasks')->with('tasks',$data);
        }
        //return redirect()->back();
        //dd($request->all());
    }
    public function UpdateTaskAsCompleted($id){
        $task=Task::find($id);
        $task->iscompleted=1;
        $task->save();
        return redirect()->back();
    }
    public function UpdateTaskAsNotCompleted($id){
        $task=Task::find($id);
        $task->iscompleted=0;
        $task->save();
        return redirect()->back();
    }
    public function DeleteTask($id){
        $task=Task::find($id);

        $task->delete();
        return redirect()->back();
    }
    public function UpdateTaskView($id){
        $task=Task::find($id);

        return view('updatetask')->with('taskdata',$task);
    }
}
