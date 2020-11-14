@extends('main')

@section('title', '| Create jobPost')

@section('stylesheets')
    {!! Html::style('css/parsley.css') !!} 
    {!! Html::style('css/select2.min.css') !!} 
@endsection

@section('content')
    
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1>Create New Job Post</h1>
            <hr>
            {!! Form::open(['route' => 'jobs.store', 'data-parsley-validate' => '' ]) !!}

                {{ Form::label('company_name', 'Company Name:') }} 
                {{ Form::text('company_name', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }} 
                <br>
                {{ Form::label('job_title', 'Job Title:') }} 
                {{ Form::text('job_title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }} 
                <br>
                {{ Form::label('vacancy', "Vacancy:") }}
                {{ Form::number('vacancy', null, array('class' => 'form-control', 'required' => '')) }}
                <br>
                {{ Form::label('slug', 'Slug URL:') }} 
                {{ Form::text('slug', null, array('class' => 'form-control', 'required' => '', 'minlength' => '5','maxlength' => '255')) }} 
                <br>
                {{ Form::label('category_id', 'JOB Category:') }} 
                <select name="category_id" id="category_id" class="form-control">
                    <option style="font-style:italic;color:orangered;" value="#" selected>Choose a Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <br>
                {{ Form::label('job_description', "Job Details:") }}
                {{ Form::textarea('job_description', null, array('class' => 'form-control', 'required' => '')) }}
                <br>
                {{ Form::label('salary', "Salary Range:") }}
                {{ Form::text('salary', null, array('class' => 'form-control', 'required' => '')) }}
                <br>
                {{ Form::label('location', "Location:") }}
                {{ Form::text('location', null, array('class' => 'form-control', 'required' => '')) }}
                <br>
                {{ Form::label('tags', 'TAGs:') }} 
                <select name="tags[]" id="tags[]" class="form-control select2-multiple" multiple="multiple">
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
                <br><br>
                {{ Form::submit('Create Job', array('class' => 'btn btn-success btn-lg btn-block')) }}
                
            {!! Form::close() !!}
            <br>
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