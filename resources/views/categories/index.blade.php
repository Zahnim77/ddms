@extends('main')

@section('title', '| JOB Categories')

@section('content')
    <div class="row">
        <div class="col-md-7">
            <h1>Categories</h1>
            <hr>
            <h3>Total: {{ $categories->total() }} </h3>
            <br>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>iD</th>
                        <th>Category Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        {!! Form::model($category, ['route' => ['categories.update', $category->id], 'method' => 'PATCH', 'data-parsley-validate' => '' ]) !!}
                        <td>{{ $category->id }}</td>
                        <td>
                            {{ Form::text('name', null, array('class' => 'form-control', 'required' => '')) }}
                        </td>
                        <td>
                            {{ Form::submit('Update', ['class' => 'btn btn-warning btn-sm']) }}
                        
                        {!! Form::close() !!}    
                        
                        {!! Form::open(['route' => ['categories.destroy', $category->id], 'method' => 'DELETE', 'style'=>'display:inline; margin-left:8px']) !!}
                        {{ Form::submit('Delete', array('class' => 'btn btn-danger btn-sm')) }}
                        {!! Form::close() !!}
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {!! $categories->links() !!} <!-- pagination -->
        </div>

        <div class="col-md-4 offset-md-1">
            <br><br><br>
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