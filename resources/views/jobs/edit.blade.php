@extends('main')

@section('title', '| Edit Job Post')

@section('stylesheets')
    {!! Html::style('css/parsley.css') !!}  
    {!! Html::style('css/select2.min.css') !!} 
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

        {!! Form::model($job, ['route' => ['jobs.update', $job->id], 'method' => 'PUT', 'data-parsley-validate' => '' ]) !!}
            
            {{ Form::label('company_name', 'Company Name:') }} 
            {{ Form::text('company_name', null , array('class' => 'form-control', 'style'=>'font-size:1.5rem', 'required' => '', 'maxlength' => '255')) }} 
            <br>
            {{ Form::label('job_title', 'Job Title:') }} 
            {{ Form::text('job_title', null, array('class' => 'form-control', 'style'=>'font-size:1.5rem', 'required' => '', 'maxlength' => '255')) }} 
            <br>
        </div>
        <div class="col-md-8">
            {{ Form::label('vacancy', "Vacancy:") }}
            {{ Form::number('vacancy', null, array('class' => 'form-control', 'required' => '')) }}
            <br>
            {{ Form::label('category_id', "JOB Category:") }}
            {{ Form::select('category_id', $categories, null, ['class'=>'form-control']) }}
            <br>
            {{ Form::label('salary', "Salary Range:") }}
            {{ Form::text('salary', null, array('class' => 'form-control', 'required' => '')) }}
            <br>
            {{ Form::label('location', "Location:") }}
            {{ Form::text('location', null, array('class' => 'form-control', 'required' => '')) }}
            <br>
        </div>
        <div class="col-md-4">
            <div class="well">
                <dl class="dl-horizontal">
                    <dt>Created at:</dt>
                    <dd style="color:green;">{{ date('jS M\'Y h:i A', strtotime($job->created_at)) }}</dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>Last Updated:</dt>
                    <dd style="color:green;">{{ date('jS M\'Y h:i A', strtotime($job->updated_at)) }}</dd>
                </dl>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        {!! Html::linkRoute('jobs.show', 'Cancel', array($job->id), array('class' => 'btn btn-light btn-block')) !!}
                    </div>
                    <div class="col-sm-6">
                        {{ Form::submit('Update', ['class' => 'btn btn-success btn-block']) }}
                    </div>
                </div>
            </div>
            <br>
            {{ Form::label('tags', "TAGs:") }}
            {{ Form::select('tags[]', $tags, null, ['class' => 'form-control select2-multiple', 'multiple' => 'multiple']) }}
            <br><br>
            {{ Form::label('slug', 'Slug URL:') }} 
            {{ Form::text('slug', null, array('class' => 'form-control', 'required' => '', 'minlength' => '5', 'maxlength' => '255')) }} 
        </div>
        <div class="col-md-12">
            {{ Form::label('job_description', "Job Details:") }}
            {{ Form::textarea('job_description', null, array('class' => 'form-control', 'required' => '')) }}

        {!! Form::close() !!}
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