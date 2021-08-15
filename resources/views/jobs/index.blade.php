@extends('main')

@section('title', '| All Jobs')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <h1>Jobs</h1>
        </div>
        <div class="col-md-2">
            <a href="{{ route('jobs.create') }}" class="btn btn-primary btn-lg">Add New Job</a>
        </div>
        <div class="col-md-12">
            <hr>
        </div>
    </div><!-- Head row -->
    
    <div class="row"><!-- Jobs row -->
        <div class="col-md-12">
            <div class="text-center">
                <h3>Total Jobs: {{ $jobs->total() }} </h3>
            </div>
            <table class="table table-hover"> 
                <thead class="thead-dark">
                    <tr>
                        <th>Job Title</th>
                        <th>Vacancy</th>
                        <th class="text-center">Job Details</th>
                        <th>Location</th>
                        <th>Posted</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($jobs as $job)    
                    <tr>
                        
                        <th>{{ $job->job_title }}</th>
                        <td style="color:blue;">{{ $job->vacancy }}</td>

                        <td>
                            {{ substr(strip_tags($job->job_description), 0, 250) }}
                            <br>
                            {{ strlen(strip_tags($job->job_description)) > 250 ? "....." : "" }}
                        </td>

                        <td>{{ $job->location }}</td>
                        <td style="color:green;">{{ date('jS M\'Y', strtotime($job->created_at)) }}</td>
                        
                        <td>
                            <a href="{{ route( 'jobs.show', $job->id ) }}" class="btn btn-secondary btn-sm">View</a>
                            <div><br></div>
                            <a href="{{ route( 'jobs.edit', $job->id ) }}" class="btn btn-warning btn-sm">Edit</a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $jobs->links() !!} <!-- pagination -->
            <div class="text-center">
                {!! $jobs->currentPage(); !!}
            </div>
        </div>
    </div>
@endsection