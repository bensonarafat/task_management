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
        <form action="{{ route("projects.store") }}" method="post">
            @csrf
            <div class="form-group mb-3">
                <label for="">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div class="col-sm-7">
        @if(count($projects) > 0)
            <div class="list-group">
                @foreach ($projects as $row)
                    <div class="list-group-item">
                        <div class="d-flex flex-row mb-3 justify-content-between">
                            <div>
                                {{ $row->name }}
                            </div>
                            <div class="d-flex">
                                <a href="{{ route("projects.edit", $row->id) }}" class="btn btn-sm btn-success" style="margin-right:10px;">Edit</a>
                                <form action="{{route('projects.destroy',[$row->id])}}" method="POST">
                                    @method("delete")
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center mt-5">
                <h3>Project is Empty</h3>
            </div>
        @endif
    </div>

  </div>

@endsection
