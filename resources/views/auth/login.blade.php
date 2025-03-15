<html lang="en" dir="ltr">

<head>


    <meta charset="utf-8">
    <title>REAMAIN | LOGIN </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin &amp; Dashboard Template" name="description">
    <meta content="" name="author">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">



    <!-- App css -->
    @include('components.head-css')

</head>

<body id="body" class="auth-page card-bg enlarge-menu">
    <!-- Log In page -->
    <div class="container-fluid">
        <div class="row vh-100">
            <div class="col-12">
                <div class="card-body p-0">
                    <div class="row d-flex align-items-center">
                        <div class="col-md-5 col-xl-3 col-lg-4">
                            <div class="card mb-0 border-0">
                                <div class="card-body p-0">
                                    <div class="text-center p-3">
                                        <a href="index.html" class="logo logo-admin">
                                            <img src="assets/images/logo-sm.png" height="50" alt="logo"
                                                class="auth-logo">
                                        </a>
                                        <h4 class="mt-3 mb-1 fw-semibold font-18">Let's Get Started REMAIN</h4>
                                        <p class="text-muted  mb-0">Sign in to continue to REMAIN.</p>
                                    </div>
                                </div><!--end card-body-->
                                <div class="card-body pt-0">
                                    <form class="my-4" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group mb-2">
                                            <label class="form-label" for="email">email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Enter email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div><!--end form-group-->

                                        <div class="form-group">
                                            <label class="form-label" for="userpassword">Password</label>
                                            <input type="password" class="form-control" name="password"
                                                id="userpassword" placeholder="Enter password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div><!--end form-group-->

                                        <div class="form-group row mt-3">
                                            <div class="col-sm-6">
                                                <div class="form-check form-switch form-switch-success">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="customSwitchSuccess">
                                                    <label class="form-check-label" for="customSwitchSuccess">Remember
                                                        me</label>
                                                </div>
                                            </div><!--end col-->
                                            <div class="col-sm-6 text-end">
                                                <a href="auth-recover-pw.html" class="text-muted font-13"><i
                                                        class="dripicons-lock"></i> Forgot password?</a>
                                            </div><!--end col-->
                                        </div><!--end form-group-->

                                        <div class="form-group mb-0 row">
                                            <div class="col-12">
                                                <div class="d-grid mt-3">
                                                    <button class="btn btn-primary" type="submit">Log In <i
                                                            class="fas fa-sign-in-alt ms-1"></i></button>
                                                </div>
                                            </div><!--end col-->
                                        </div> <!--end form-group-->
                                    </form><!--end form-->

                                    <hr class="hr-dashed mt-4">

                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div><!--end col-->
                        <div class="col-md-7 col-xl-9 col-lg-8  p-0 vh-100 d-flex justify-content-center auth-bg">
                            <div class="accountbg d-flex align-items-center">
                                <div class="account-title text-center text-white">
                                    <img src="assets/images/logo-sm.png" alt="" class="thumb-sm">
                                    <h4 class="mt-3 text-white">Welcome To <span class="text-warning">REMAIN</span>
                                    </h4>
                                    <h1 class="text-white">Let's Get Started</h1>
                                    <p class="font-18 mt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        Aliquam laoreet tellus ut tincidunt euismod.</p>
                                    <div class="border w-25 mx-auto border-warning"></div>
                                </div>
                            </div><!--end /div-->
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end card-body-->
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
    <!-- vendor js -->

    @include('components.script')



</body>

</html>
