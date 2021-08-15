@extends('main')
<?php $name = Auth::guard('company')->user()->name; ?>
@section('title', "| $name")

@section('stylesheets')
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2 offset-md-10">
                <a href="{{ route('company.create') }}" class="btn btn-primary btn-lg">Add New Job</a>
            </div>
        </div>
        
        <br>
        <div class="card">
            <div class="card-header">
                COMPANY Dashboard
                <small>
                    <span class="w3-tag w3-round w3-yellow">
                        <span class="w3-badge w3-red">{{ $jobs->count() }}</span> Jobs
                    </span>
                </small>
            </div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <table class="table table-hover"> 
                    <thead class="thead-dark">
                        <tr>
                            <th>Job Title</th>
                            <th>Vacancy</th>
                            <th class="text-center">Job Details</th>
                            <th>Number of Applicants</th>
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
    
                            <td><a href="{{ route( 'company.applicants', ['company'=>$job->company->id, 'job'=>$job->id] ) }}" class="btn btn-info btn-block" target="_blank">
                                <span class="w3-tag w3-round w3-yellow">
                                    <span class="w3-badge w3-red">{{ $job->users()->count() }}</span> Applications
                                </span>
                            </a></td>

                            <td style="color:green;">{{ date('jS M\'Y', strtotime($job->created_at)) }}</td>
                            
                            <td>
                                <a href="{{ route( 'company.show', ['company'=>$job->company->id, 'job'=>$job->id] ) }}" class="btn btn-secondary btn-sm">View</a>
                                <div><br></div>
                                <a href="{{ route( 'company.edit', ['company'=>$job->company->id, 'job'=>$job->id] ) }}" class="btn btn-warning btn-sm">Edit</a>
                            </td>
    
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
