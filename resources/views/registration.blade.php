<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/form-elements.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

    <title>Registration</title>
  </head>
<body>
    <div class="top-content">
        	
        <div class="inner-bg">
            <div class="container">
                
                <div class="row">
                    <div class="col-md-8 offset-sm-2 text">
                        <h1><strong>Friends</strong> Login &amp; Register Forms</h1>
                        
                    </div>
                </div>
               
                <div class="row">
                    <div class="col-md-5">
                        
                        <div class="form-box">
                            <div class="form-top">
                                <div class="form-top-left">
                                    <h3>Login to our site</h3>
                                    <p>Enter username and password to log on:</p>
                                    
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-key"></i>
                                </div>
                            </div>
                            <div class="form-bottom">
                            <form role="form" action="{{ route("doLogin") }}" method="post" class="login-form" >
                                @csrf
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <label class="sr-only" for="username">Username</label>
                                        <input type="text" name="username" placeholder="Username..." class="form-username form-control" id="log_username">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="password">Password</label>
                                        <input type="password" name="password" placeholder="Password..." class="form-password form-control" id="log_password">
                                    </div>
                                    <button type="button" class="btn" id="btn_login">Sign in!</button>
                                </form>
                                
                                <div class="" id="log_error">
                                    
                                </div>
                            </div>
                        </div>
                    
                    
                        
                    </div>
                    
                    <div class="col-sm-1 middle-border"></div>
                    <div class="col-sm-1"></div>
                        
                    <div class="col-md-5 ">
                        
                        <div class="form-box">
                            <div class="form-top">
                                <div class="form-top-left">
                                    <h3>Sign up now</h3>
                                    <p>Fill in the form below to get instant access:</p>
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-pencil"></i>
                                </div>
                            </div>
                            <div class="form-bottom">
                            <form role="form" action="{{ route("doRegist") }}" method="post" class="registration-form">
                                @csrf
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
                                    <div class="form-group">
                                        <label class="sr-only" for="form-first-name">First name</label>
                                        <input type="text" id="first_name" name="first_name" placeholder="First name..." class="form-first-name form-control" id="first-name">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-last-name">Last name</label>
                                        <input type="text" id="last_name" name="last_name" placeholder="Last name..." class="form-last-name form-control" id="last-name">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-email">Email</label>
                                        <input type="text" id="email" name="email" placeholder="Email..." class="form-email form-control" id="email">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-email">Username</label>
                                        <input type="text" id="reg_username" name="reg_username" placeholder="Username..." class="form-email form-control" id="reg_username">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-email">Password</label>
                                        <input type="password" id="reg_password" name="reg_password" placeholder="Password..." class="form-email form-control" id="reg_password">
                                    </div>
                                    <button type="button" id="btn_registration" class="btn">Sign me up!</button>
                                    
                                </form>
                                <div id="reg_error" class="">
                                    
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
        
    </div>
    <script src="{{ asset("/vendor/js/jquery.js") }}"></script>
    <script src="{{ asset("/vendor/js/bootstrap.min.js") }}"></script>
    <script src="{{ asset("/js/registration.js") }}"></script>
    <script src="{{ asset("/js/login.js") }}"></script>

</body>
</html> 


