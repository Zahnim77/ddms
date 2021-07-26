@extends('main')

@section('title', "| $user->name Home")

@section('stylesheets')
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
@endsection

@section('content')
<div class="container">
    @if ($user->jobs()->count() <= 0)
        <div class="alert alert-warning" role="alert">
            You've not applied for a job yet.
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2 offset-md-10">
                    <a href="{{ route('view.index') }}" class="btn btn-dark">Apply for Jobs</a>
                </div>
            </div>
            
            <br>
            <div class="card">
                <div class="card-header">
                    {{ $user->name }} Dashboard
                    <small>
                        (Applied to
                        <span class="w3-tag w3-round w3-yellow">
                            <span class="w3-badge w3-red">{{ $user->jobs()->count() }}</span> Jobs
                        </span>)
                    </small>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-center">Job Title</th>
                                        <th>Company</th>
                                        <th>Location</th>
                                        <th>Skills Needed</th>
                                        <th>Posted</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user->jobs()->orderBy('created_at', 'asc')->get() as $job)
                                        <tr>
                                            <th>{{ $job->job_title }}</th>
                                            <th style="color:darkmagenta">{{ $job->company_name }}</th>
                                            <td style="color:blue">{{ $job->location }}</td>
                                            <td>
                                                @foreach ($job->tags as $tag)
                                                <span class="w3-tag w3-round w3-teal">
                                                    {{ $tag->name }}
                                                </span>
                                                @endforeach
                                            </td>                                            
                                            <td>
                                                {{ date('jS M\'Y', strtotime($job->created_at)) }}
                                            </td>
                                            <td>
                                                <a href="{{ route('view.single', $job->slug) }}" class="btn btn-light btn-sm">
                                                    Job View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection