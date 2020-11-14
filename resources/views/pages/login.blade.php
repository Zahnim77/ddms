<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/gif" href="{{ asset('img/favicon.ico') }}">
        <title>IOE :: DDMS</title>
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">
        <!--  Bootstrap SECTION 
	    -----------------------------------------------------------------------------END -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    </head>
    <body style="text-align: center; padding-top: 100px;" class="slideUp">
        
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif  
        </div>
        
        <div class="container ddms_wrap">
	        <div class="row">
                <div class="col-md-12">
                    <h1>Welcome To <span class="bgLogo"></span> (Bangladesh) Limited.</h1>
                </div>
	       </div>
        </div>
        
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                </div>
            <div class="col-md-4">
                <div class="userBox">
                    <div class="userName">
                        <label>User</label>
                        <input class="form-control" type="text" name="userName">
                    </div>
                    <div class="userPass">
                        <label>Password</label>
                        <input class="form-control" type="password" name="password">
                    </div>
                    <input type="submit" name="submit" value="Submit" class="btnSubmit">
                </div> <!-- .userBox -->
            </div>
            <div class="col-md-4">
            </div>
            </div>
        </div>
        
    </body>
</html>
