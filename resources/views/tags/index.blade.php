@extends('main')

@section('title', '| Tags')

@section('content')
    <div class="row">
        <div class="col-md-7">
            <h1>TAGs</h1>
            <hr>
            <h3>Total: {{ $tags->total() }} </h3>
            <br>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>iD</th>
                        <th class="text-center">TAG Name</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $tag)
                    <tr>
                        {!! Form::model($tag, ['route' => ['tags.update', $tag->id], 'method' => 'PATCH', 'data-parsley-validate' => '' ]) !!}
                        <td>{{ $tag->id }}</td>
                        <td>
                            {{ Form::text('name', null, array('class' => 'form-control', 'required' => '')) }}
                        </td>
                        <td>
                            {{ Form::submit('Update', ['class' => 'btn btn-warning btn-sm']) }}
                            {!! Html::linkRoute('tags.show', 'Linked Jobs >>', array($tag->id), array('class' => 'btn btn-info btn-sm')) !!}
                        {!! Form::close() !!}    
                        
                        {!! Form::open(['route' => ['tags.destroy', $tag->id], 'method' => 'DELETE', 'style'=>'display:inline; margin-left:8px']) !!}
                        <?php 
                            if ($tag->jobs()->count() > 0) {
                                $confirm = "confirm"; 
                            } else {
                                $confirm = "";
                            } 
                        ?>
                            {{  Form::submit('Delete', array('class' => 'btn btn-danger btn-sm '.$confirm, 'data-toggle' =>'tooltip')) }}
                        {!! Form::close() !!}
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {!! $tags->links() !!} <!-- pagination -->
        </div>

        <div class="col-md-4 offset-md-1">
            <br><br><br>
            <div class="card bg-light p-3">

            {!! Form::open(['route' => 'tags.store']) !!}
                <h5 class="card-title">Create New TAG</h5>

                {{  Form::text('name', null, ['class'=>'form-control'])  }}
                <br>
                {{ Form::submit('Submit', ['class'=>'btn btn-secondary']) }}
                
            {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript">
    var str = "The TAG is linked to other jobs.\r\n\nAre you sure you want to delete this?";
    $('.confirm').click(function(e) {
        if(!confirm(str)) {
            e.preventDefault();
        }
    });
</script>
@endsection