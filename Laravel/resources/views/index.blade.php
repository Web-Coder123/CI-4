@extends('layouts.app')

@section('content')
  <div class="row justify-content-center">
    <div class="col-12 col-sm-6">
      <hr>
      <div class="text-center">
        <a href="{{ route('add-task') }}" class="btn btn-success">Add Task</a>  
      </div>
      <hr> 
      <div class="card">
        <div class="card-header">
          Tasks
        </div>
        <ul class="list-group list-group-flush">
          @foreach($tasks as $task)
            
            <li class="list-group-item"><a href="#">{{ $task->description}}</a></li>    
            
            
          @endforeach
        </ul>
      </div>
    </div>
  </div>
@endsection
