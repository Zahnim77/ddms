@extends('main')

@section('title')

@section('content')  
    <div class="container">
      <div class="row">
          <div class="col-md-12">
            <div class="jumbotron">
              <h1>Welcome to my Job Portal</h1>
              <p class="lead">Thank you very much for visiting. This is a test website built with Laravel</p>
              <h4>ADMIN Panel: 
                <span>
                  <a href="{{ route('admin.dashboard') }}">{{ route('admin.dashboard') }}</a>
                </span>
              </h4>
              <p>
                <strong>Username: </strong>
                <span style="color:orange;">Minhaz</span>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <strong>Password: </strong>
                <span style="color:orange;">password</span>
              </p>
            </div>
          </div>
      </div>
      <div class="row">
        <div class="col-md-8">

          @foreach ($jobs as $job)
          <div class="job-post">

            <h4>{{ $job->job_title }}</h4>

            <h4>Vacancy: 
              <span style="color:blue;">{{ $job->vacancy }}</span>
              <span style="float:right; color:orange;">
                {{ $job->location }}
              </span>
            </h4>

            <p>
              {{ substr($job->job_description, 0, 300) }}
              &nbsp;
              {{ strlen($job->job_description) > 250 ? "....." : "" }}
            </p>
            <a href="{{ url('view/'.$job->slug) }}" class="btn btn-dark">.. Read more</a>
          </div>
          <hr>
          @endforeach
          
        </div>
        <div class="col-md-3 offset-md-1">
          <h2>Sidebar</h2>
        </div>
      </div>
      <div class="links">
      </div>

    </div>

  </div>    
@endsection