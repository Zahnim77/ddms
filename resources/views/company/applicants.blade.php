@extends('main')
<?php $name = Auth::guard('company')->user()->name; ?>
@section('title', "| $name| $job->job_title")

@section('stylesheets')
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2 offset-md-10">
                <h4>{{ $job->company_name }}</h4>
            </div>
        </div>
        
        <br>
        <div class="card">
            <div class="card-header">
                {{ $job->job_title }}
                <small>
                    <span class="w3-tag w3-round w3-yellow">
                        <span class="w3-badge w3-red">{{ $job->users()->count() }}</span> Applied
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
                            <th class="text-center">Username</th>
                            <th class="text-center">Profile Photo</th>
                            <th class="text-center">Skills</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Show CV</th>
                        </tr>
                    </thead>
    
                    <tbody>
                        @foreach ($job->users()->orderBy('id', 'asc')->get() as $user)    
                        <tr>
                            
                            <th class="text-center">{{ $user->name }}</th>
                            <td>
                                <img src="{{ asset('/storage/avatars/'.$user->avatar) }}" height="100px;"
                                alt="{{ $user->avatar }}" width="25%" style="margin-right:200px;float:right;"/>
                            </td>
                            <td>
                                @foreach ($user->tags as $tag)
                                <span class="w3-tag w3-round w3-teal">
                                    {{ $tag->name }}
                                </span>
                                @endforeach
                            </td>
                            <td>
                                <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                            </td>

                            <td>
                                <a href="{{ asset('/storage/cvs/'.$user->cv) }}" class="btn btn-outline-success" target="_blank">Open_CV</a>
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
