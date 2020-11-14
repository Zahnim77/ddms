@extends('main')

@section('title', '| Edit Job Post')

@section('stylesheets')
    {!! Html::style('css/parsley.css') !!}  
    {!! Html::style('css/select2.min.css') !!} 
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">USER Profile</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-12">
                            <file-upload inline-template>
                                <div id="app">
                                <form @submit.prevent="submitForm" model=$user>
                                    <div class="form-group">
                                        <label for="name">Username</label>
                                        <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}" v-model="formData.name">
                                      </div>
                            
                                      <div class="form-group">
                                        <label for="avatar">Upload Photo</label>
                                        <input type="file" name="avatar" class="form-control-file" id="avatar" @change="onFileChange">
                                      </div>
                            
                                      <img v-bind:src="imagePreview" width="100" height="100" v-show="showPreview"/> 
                                      <br><br>
                                      <div class="form-group">
                                        <input type="submit" class="btn btn-outline-primary btn-block" value="Update Profile"/>
                                      </div>
                                </form>
                                </div>
                            </file-upload>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="js/app.js"></script>
@endsection
