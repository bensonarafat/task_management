@extends("layout.app")
@section("content")

  <div class="text-center my-5">
    <a href="/"><p>Home</p></a>
    <h2>Projects</h2>
  </div>


  {{-- Alert Components --}}
  @include("components.alert")
  {{-- Alert Components --}}

  <div class="row">
    <div class="col-sm-4">
        <form action="{{ route("projects.update", $project->id) }}" method="post">
            @csrf
            @method("PUT")
            <div class="form-group mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ $project->name }}" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
  </div>

@endsection
