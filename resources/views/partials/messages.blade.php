@if (Session::has('success'))
    <br>
    <div class="alert alert-success" role="alert">
        <strong>Success:</strong> {{ Session::get('success') }}
    </div>
@endif

@if (count($errors) > 0)
    <br>
    <div class="alert alert-danger" role="alert">
        <strong>Errors: </strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>        
            @endforeach
        </ul>
    </div>
@endif

@if (Session::has('delete'))
    <br>
    <div class="alert alert-dark" role="alert">
        <strong>Deleted:</strong> {{ Session::get('delete') }}
    </div>
@endif

@if (Session::has('caution'))
    <br>
    <div class="alert alert-warning" role="alert">
        <strong>Caution:</strong> {{ Session::get('caution') }}
    </div>
@endif