@extends('main')

@section('title', '| Jobs')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1>Jobs: {{ $jobs->total() }}</h1>
            <hr>
        </div>
    </div>

    @foreach ($jobs as $job)
    <div class="row">
        <div class="col-md-8 offset-md-2">

            <h3>{{ $job->job_title }}</h3>

            <h5>Vacancy: 
                <span style="color:blue;">
                    {{ $job->vacancy }}
                </span>
                <span style="float:right; color:green;">
                    {{ date('jS M\'Y', strtotime($job->created_at)) }}
                </span>
                <span style="float: right;">Published at:&nbsp;</span>
            </h5>

            <p>
                {{ substr(strip_tags($job->job_description), 0, 250) }}
                &nbsp;
                {{ strlen(strip_tags($job->job_description)) > 250 ? "....." : "" }}
            </p>

            <a href="{{ route('view.single', $job->slug) }}" class="btn btn-link">.. Read more</a>
            <br>
            <br>
        </div>
    </div>
    @endforeach
    
    <div class="row">
        <div class="col-md-12">
            {!! $jobs->links() !!}
        </div>
    </div>
@endsection