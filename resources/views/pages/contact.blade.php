@extends('main')

@section('title', '| Contact')

@section('content')
  <br>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Contact Me</h1>
      </div>
    </div>
    <form action="{{ url('contact') }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="email">Email: </label>
        <input id="email" type="email" name="email" class="form-control">
      </div>
      <div class="form-group">
        <label for="subject">Subject: </label>
        <input id="subject" type="subject" name="subject" class="form-control">
      </div>
      <div class="form-group">
        <label for="message">Message: </label>
        <textarea id="message" Message"message" name="message" placeholder="Type your message here..." class="form-control"></textarea>
      </div>
      <input type="submit" value="Send Message" class="btn btn-info">
    </form>
  </div>
@endsection