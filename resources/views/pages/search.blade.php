@extends('main')

@section('title', '| Search Results')

@section('stylesheets')
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2>Search result for <span style="color: blue">{{ $tag->name }}</span> :
                <small>
                    <span class="w3-tag w3-round w3-yellow">
                        <span class="w3-badge w3-red">{{ $tag->jobs()->count() }}</span> jobs found.
                    </span>
                </small>
            </h2>
            <hr>
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
                                <a href="{{ route('view.single', $job->slug) }}" class="btn btn-light btn-sm" target="_blank">
                                    View Details
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection