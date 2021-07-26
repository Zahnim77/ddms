@extends('main')

@section('title')

@section('stylesheets')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
@endsection

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

              <h4>Company Panel: 
                <span>
                  <a href="{{ route('company.dashboard') }}">{{ route('company.dashboard') }}</a>
                </span>
              </h4>
              <p>
                <strong>Email: </strong>
                <span style="color:orange;">sohan@example.com</span>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <strong>Password: </strong>
                <span style="color:orange;">password</span>
              </p>
              
              <h4>User Panel: 
                <span>
                  <a href="{{ route('home') }}">{{ route('home') }}</a>
                </span>
              </h4>
              <p>
                <strong>Email: </strong>
                <span style="color:orange;">minhaz.060@gmail.com</span>
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
          
          <div class="row">
            {!! $jobs->links() !!}
          </div>

        </div>
        <div class="col-md-3 offset-md-1">
          <h2>Sidebar</h2>
          <br><br>
          <section class="wow fadeIn animated" style="visibility: visible; animation-name: fadeIn; margin-left:25px;">
            <div class="row">
            <a href="/view">
              <div class="col-md-3 col-sm-6 bottom-margin text-center counter-section wow fadeInUp sm-margin-bottom-ten animated" data-wow-duration="10ms" style="visibility: visible; animation-duration: 10ms; animation-name: fadeInUp;"> <i class="fa fa-briefcase medium-icon"></i> <span id="anim-number-pizza" class="counter-number"></span> <span class="timer counter alt-font appear" data-to="980" data-speed="7000">{{ $jobTotal->count() }}</span>
                <p class="counter-title">Jobs</p>
              </div>
            </a>
            </div>
            <br><br>
            <div class="row">
              <div class="col-md-3 col-sm-6 bottom-margin text-center counter-section wow fadeInUp sm-margin-bottom-ten animated" data-wow-duration="1ms" style="visibility: visible; animation-duration: 1ms; animation-name: fadeInUp;"> <i class="fa fa-sort-alpha-asc medium-icon"></i> <span id="anim-number-pizza" class="counter-number"></span> <span class="timer counter alt-font appear" data-to="980" data-speed="7000">{{ $categories->count() }}</span>
                <p class="counter-title">Categories</p>
              </div>
            </div>
            <br><br>
            <div class="row">
              <div class="col-md-3 col-sm-6 bottom-margin text-center counter-section wow fadeInUp sm-margin-bottom-ten animated" data-wow-duration="5ms" style="visibility: visible; animation-duration: 5ms; animation-name: fadeInUp;"> <i class="fa fa-user medium-icon"></i> <span id="anim-number-pizza" class="counter-number"></span> <span class="timer counter alt-font appear" data-to="980" data-speed="7000">{{ $users->count() }}</span>
                <p class="counter-title">Users</p>
              </div>
            </div>
            <br><br>
            <div class="row">
              <div class="col-md-3 col-sm-6 bottom-margin text-center counter-section wow fadeInUp sm-margin-bottom-ten animated" data-wow-duration="5ms" style="visibility: visible; animation-duration: 5ms; animation-name: fadeInUp;"> <i class="fa fa-anchor medium-icon"></i> <span id="anim-number-pizza" class="counter-number"></span> <span class="timer counter alt-font appear" data-to="980" data-speed="7000">{{ $companies->count() }}</span>
                <p class="counter-title">Companies</p>
              </div>
            </div>
          </section>
        </div>
      </div>
      <div class="links">
      </div>

    </div>

  </div>    
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" crossorigin="anonymous"></script>

    <script type="text/javascript">
    $(document).ready(function() {

      $('.counter').each(function () {

        $(this).prop('Counter',0).animate({
          Counter: $(this).text()
        }, {
        duration: 4000,
        easing: 'swing',
        step: function (now) {
          $(this).text(Math.ceil(now));
          }
        });
      });

    });
    </script>
@endsection