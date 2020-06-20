@extends('layouts.app')


@section('content')

  <div class="row justify-content-center">
    <div class="col-12 col-sm-6">
      <hr>
      <div class="text-center">
        <a href="{{ route('home') }}" class="btn btn-primary">Go Back</a>
      </div>
      <hr>
      <form action="{{ route('process-add-task') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" name="title" id="title" class="form-control">
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>

@endsection