@extends('main')

@section('title', "| $user->name Profile")

@section('stylesheets')
    {!! Html::style('css/parsley.css') !!}  
    {!! Html::style('css/select2.min.css') !!} 
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">USER Profile</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::model($user, ['route' => ['update.profile', $user->id], 'method' => 'PUT', 'files' => true, 'data-parsley-validate' => '' ]) !!}

                                {{ Form::label('name', 'Username:') }} 
                                {{ Form::text('name', null , array('class' => 'form-control', 'style'=>'font-size:1.5rem', 'required' => '', 'maxlength' => '255')) }}
                                <br>
                                {{ Form::label('avatar', 'Upload Photo:') }}
                                <br>
                                @isset($user->avatar)
                                <img src="{{ asset('/storage/avatars/'.$user->avatar) }}" alt="{{ $user->avatar }}" />
                                <br>
                                @endisset
                                <br>
                                {{ Form::file('avatar', array('class' => 'form-control')) }}
                                <br>
                                {{ Form::label('tags', "Choose Your Skills: ") }} <span style="color:blue;font-size:large;">{{ $user->tags->count() }}</span>
                                {{ Form::select('tags[]', $tags, null, ['class' => 'form-control select2-multiple', 'multiple' => 'multiple']) }}
                                <br><br>
                                {{ Form::label('cv', 'Upload Updated CV:') }}
                                <br>
                                {{ Form::file('cv', array('class' => 'form-control')) }}
                                <br>
                                @isset($user->cv)
                                <iframe src = "/js/ViewerJS/#{{ asset('/storage/cvs/'.$user->cv) }}" width='100%' height='360' allowfullscreen webkitallowfullscreen></iframe>
                                <br>
                                @endisset
                                <br>
                                <div class="col-md-4 offset-md-4">
                                    {{ Form::submit('Update Profile', ['class' => 'btn btn-outline-primary btn-block']) }}
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    {!! Html::script('js/parsley.min.js') !!}

    {!! Html::script('js/select2.min.js') !!}
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2-multiple').select2();
        });
    </script>
@endsection