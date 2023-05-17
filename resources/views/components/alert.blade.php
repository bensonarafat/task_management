@if(Session::has("success"))
<div class="alert alert-success" role="alert">
    <strong>Success!</strong> {{ session::get("success") }}.
</div>
@endif
@if(Session::has("error"))
    <div class="alert alert-danger" role="alert">
        <strong>Error!</strong> {{ session::get("error") }}.
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger" role="alert">
        <strong>Error!</strong> Opps Something went wrong
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
          </ul>
    </div>
@endif
