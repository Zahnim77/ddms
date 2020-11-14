@extends('main')

@section('title', '| JOB Categories')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h1>Categories</h1>
            <hr><br>
            @foreach($categories->chunk(3) as $chunks)
            <div class="row">
                @foreach($chunks as $category)
                <div class="col-sm-4">
                    <ul>
                        <li>
                            <a href="#">{{ $category->name }}</a>
                        </li>
                    </ul>
                </div>
                @endforeach 
            </div>
            @endforeach
        </div>

        <div class="col-md-3 offset-md-1">
            <br>
            <div class="card bg-light p-3">

            {!! Form::open(['route' => 'categories.store']) !!}
                <h5 class="card-title">Create New Category</h5>

                {{  Form::text('name', null, ['class'=>'form-control'])  }}
                <br>
                {{ Form::submit('Submit', ['class'=>'btn btn-secondary']) }}
                
            {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection