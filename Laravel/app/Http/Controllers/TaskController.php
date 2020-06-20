<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{
  public function index()
  {
    $tasks = Task::get();
    return view('index', [
      'tasks' => $tasks
    ]);
  }
  
  public function add()
  {
    return view('add-task');
  }
  
  public function processAdd(Request $request)
  {
//    dd($request);
    $task = new Task;
    $task->title = $request->title;
    $task->description = $request->description;
//    dump($request->title);
//    dump($task->title);
//    die();
    $task->save();
    
//    return redirect(route('home'));
    return redirect('/');
    
  }
  
}






