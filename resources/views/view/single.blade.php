@extends('main')
<?php 
    $jobTitle = htmlspecialchars($job->job_title); 
?>
@section('title', "| $jobTitle")

@section('stylesheets')
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
@endsection

@section('content')
    
    <div class="row">
        <div class="col-md-12">
            <h2>{{ $job->job_title }}</h2>
            <hr>
        </div>
        <div class="col-md-6">
            <h4>Vacancy: 
                <span style="color:blue;">{{ $job->vacancy }}</span>
            </h4>
            <h4>Salary</h4>
            <p class="lead">{{ $job->salary }}</p>
            <h4>Category: 
                <span style="color:darkmagenta;">{{ $job->category->name }}</span>
            </h4>
        </div>
        <div class="col-md-6">
            <h4>Location</h4>
            <p class="lead">{{ $job->location }}</p>

            <h4>Created at:</h4>
            <p class="lead">{{ date('jS M\'Y h:i A', strtotime($job->created_at)) }}</p>
        </div>
        <div class="col-md-12">
            <h4>TAGs: 
                @foreach ($job->tags as $tag)
                    <span class="w3-tag w3-round w3-teal">
                        {{ $tag->name }}
                    </span>
                @endforeach
            </h4>
        </div>
        <div class="col-md-12">
            <br>
            <h4>Job Details</h4>
            <p class="lead">{{ $job->job_description }}</p>
            <br>
        </div>
        <div class="col-md-4 offset-md-4">
            @if(Auth::guard('web')->check())
                <?php $userID = Auth::guard('web')->user()->id; ?>
                @isset(Auth::guard('web')->user()->cv)
                {!! Html::linkRoute('application', 'Apply', array($job->slug, $userID), array('class' => 'btn btn-success btn-block btn-lg')) !!}
                @else 
                {{ Html::linkRoute('profile', 'Apply', [$userID], array('class' => 'btn btn-success btn-block btn-lg')) }}
                @endisset
            @else 
            {{ Html::linkRoute('login', 'Apply', [], array('class' => 'btn btn-success btn-block btn-lg')) }}
            @endif
            <br><br>
        </div>
    </div>
@endsection