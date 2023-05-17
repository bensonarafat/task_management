@extends("layout.app")
@section("content")

  <div class="text-center my-5">
    <a href="/"><p>Home</p></a>
    <h2>Edit Task</h2>
  </div>


  {{-- Alert Components --}}
  @include("components.alert")
  {{-- Alert Components --}}

  <div class="row">
    <div class="col-sm-8 mx-auto">
        <form action="{{ route("tasks.update", $task->id) }}" method="post">
            @method("PUT")
            @csrf
            <div class="form-group mb-3">
                <label for="name">Task  Name</label>
                <input type="text" name="name" id="name" value="{{ $task->name }}" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label for="priority">Priority:</label>
                <input type="number" name="priority" id="priority" class="form-control" value="{{ $task->priority }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="project_id">Project:</label>
                <select name="project_id" id="project_id" class="form-control">
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}" @if($project->id == $task->project_id) selected @endif>{{ $project->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
  </div>

@endsection
