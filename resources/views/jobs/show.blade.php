@extends('main')

@section('title', '| View JobPost')

@section('stylesheets')
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
@endsection
    
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2>
                {{ $job->job_title }}
                <small><span class="w3-tag w3-round w3-orange">
                    {{ $job->company_name }} 
                </span></small>
            </h2>
            <hr>
        </div>
        <div class="col-md-8">
            <h4>Vacancy: 
                <span style="color:blue;">{{ $job->vacancy }}</span>
            </h4>
            <br>
            <h4>Salary</h4>
            <p class="lead">{{ $job->salary }}</p>
    
            <h4>Location</h4>
            <p class="lead">{{ $job->location }}</p>

            <h4>Category: 
                <span style="color:darkmagenta;">{{ $job->category->name }}</span>
            </h4>
            <br>
            <h4>TAGs: 
                @foreach ($job->tags as $tag)
                    <span class="w3-tag w3-round w3-teal">
                        {{ $tag->name }}
                    </span>
                @endforeach
            </h4>
        </div>
        <div class="col-md-4">
            <div class="card bg-light p-3">
                <dl class="dl-horizontal">
                    <dt>URL:</dt>
                    <dd style="color:blue;">
                        <a href="{{ route('view.single', $job->slug) }}">
                            {{ route('view.single', $job->slug) }}
                        </a>
                    </dd>
                </dl>
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
                        {!! Html::linkRoute('jobs.edit', 'Edit', array($job->id), array('class' => 'btn btn-warning btn-block')) !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::open(['route' => ['jobs.destroy', $job->id], 'method' => 'DELETE']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}
                        {!! Form::close() !!}
                        <br>
                    </div>
                    <div class="col-sm-12">
                        {!! Html::linkRoute('jobs.index', '<< See All', [], ['class' => 'btn btn-light btn-block']) !!}
                    </div>
                </div>
            </div>
        </div>
        <h4>Job Details</h4>
        <p class="lead">{{ $job->job_description }}</p>
    </div>
@endsection