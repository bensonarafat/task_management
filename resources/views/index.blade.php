@extends("layout.app")
@section("content")

  <div class="text-center mt-5">
    <h2>Task Management</h2>
  </div>

  {{-- Actions --}}
  <div class="d-flex flex-row mb-3 justify-content-between">
    <div class="dropdown">
        <form action="" method="get">
            <div class="form-group">
                <label for="project_id">Filter by Project:</label>
                <select name="project_id" id="project_id" class="form-control" onchange="this.form.submit()">
                    <option value=""> -- select project --</option>
                    <option value="">Show All</option>
                    @foreach ($projects as $row)
                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
    <div class="buttons">
        <a href="{{ route("tasks.create") }}" class="btn btn-primary">New Task</a>
        <a href="{{ route("projects.index") }}" class="btn btn-success">Projects</a>
    </div>
  </div>
 {{-- Actions --}}

  {{-- Alert Components --}}
  @include("components.alert")
  {{-- Alert Components --}}

  {{-- List --}}
  <div id="simpleList" class="list-group" data-url="{{ route('tasks.updateTaskOnDrag') }}">
    @if(count($tasks) > 0)
        @foreach ($tasks as $row)
            <div class="list-group-item" data-id="{{ $row->id }}">
                <div class="d-flex flex-row mb-3 justify-content-between">
                    <div class="">
                        {{ $row->name }}
                        <br/>
                        <span class="badge text-bg-warning">{{ $row->project->name }}</span>
                        <div class="d-flex mt-2">
                            <a href="{{ route("tasks.edit", $row->id) }}" class="btn btn-success btn-sm" style="margin-right:5px;">Edit</a>
                            <form action="{{route('tasks.destroy',[$row->id])}}" method="POST">
                                {{ method_field('delete') }}
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>

                        </div>
                    </div>
                    <div>
                        <strong>Drag</strong>
                    </div>
                </div>

            </div>
        @endforeach
    @else
        <div class="text-center mt-5">
            <h3>Task is Empty</h3>
        </div>
    @endif
  </div>
  {{-- List --}}

<!-- Latest Sortable -->
<script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>
<script>
    const taskSimpleList = document.getElementById('simpleList');
    Sortable.create(taskSimpleList,
                    {
                    // Called when dragging element changes position
                    onEnd: function(/**Event*/evt) {
                        const order = Array.from(taskSimpleList.children).map((e) => e.getAttribute('data-id'));
                        // console.log(taskSimpleList.getAttribute('data-url'));
                        fetch(taskSimpleList.getAttribute('data-url'), {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ task: order })
                        })
                        // log response
                        .then(data => console.log(data))
                        // catch error
                        .catch(error => console.error(error));
                        }
                    }
                    );

</script>
@endsection
