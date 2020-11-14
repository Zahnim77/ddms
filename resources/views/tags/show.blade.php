@extends('main')

@section('title', "$tag->name TAG")

@section('stylesheets')
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <br>
            <h2>TAG: {{ $tag->name }} has 
                <small>
                    <span class="w3-tag w3-round w3-yellow">
                        <span class="w3-badge w3-red">{{ $tag->jobs()->count() }}</span> Jobs
                    </span>
                </small>
            </h2>
            <hr>
        </div>
        <div class="col-md-3 offset-md-1">
            <br>
            <a href="{{ route('tags.index') }}" class="btn btn-primary btn-block">
                << Back To TAGs
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center">Job Title</th>
                        <th>Job Category</th>
                        <th>Attached TAGs</th>
                        <th>Slug URL</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tag->jobs as $job)
                        <tr>
                            <th>{{ $job->job_title }}</th>
                            <th style="color:darkmagenta">{{ $job->category->name }}</th>
                            <td>
                                @foreach ($job->tags as $tag)
                                <span class="w3-tag w3-round w3-teal">
                                    {{ $tag->name }}
                                </span>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('view.single', $job->slug) }}">
                                    {{ $job->slug }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-light btn-sm">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection