    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>LMS</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600;700;800;900&display=swap"
            rel="stylesheet">

        <link rel="stylesheet" id="css-main" href="{{ asset('css/oneui.css') }}">
        <link rel="stylesheet" href="{{ asset('js/plugins/sweetalert2/sweetalert2.min.css') }}">
      
    </head>

    <body class="bg-warning">
        <!-- MODAL RESET PASSWORD -->
        <div class="modal fade" id="modal-block-fromleft" tabindex="-1" role="dialog" aria-labelledby="modal-block-fromleft"
        aria-hidden="true">
            <div class="modal-dialog modal-dialog-fromleft" role="document">
                <div class="modal-content">
                    <div class="block block-rounded block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title modal-title-view">Reset Password</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="block-content font-size-sm pb-3">
                            <div class="form-group">
                                <input type="text"
                                class="form-control form-control-alt form-control-lg"
                                id="reset_email" placeholder="Username">
                                <span class="invalid-feedback" role="alert">
                                    <strong>Username is required</strong>
                                </span>
                            </div>
                            
                            <div class="form-group">
                                <button type="button" class="btn btn-primary btn_reset">
                                    {{ __('Request Reset') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MODAL RESET PASSWORD -->


        <!-- Page Content -->
        <div class="content">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <!-- Sign In Block -->
                    <div class="block block-rounded block-themed mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Sign In</h3>
                            {{-- <div class="block-options">
                                <a class="btn-block-option font-size-sm" href="#" id="forgot_pass">Forgot
                                    Password?</a>
                            </div> --}}
                            <div class="block-options">
                                <i class="fa fa-key text-warning"></i>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="p-sm-3 px-lg-4 py-lg-5">
                                <h1 class="h2 mb-1">LMS<span class="text-primary">CK</span> </h1>
                                <p class="text-muted">
                                    Welcome, please login.
                                </p>

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="py-3">
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control form-control-alt form-control-lg  @error('email') is-invalid @enderror"
                                                id="email" name="email" placeholder="Username">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password"
                                                class="form-control form-control-alt form-control-lg @error('password') is-invalid @enderror"
                                                id="password" name="password" placeholder="Password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="login-remember"
                                                    name="login-remember">
                                                <label class="custom-control-label font-w400"
                                                    for="login-remember">Remember Me</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6 col-xl-5">
                                            <button type="submit" class="btn btn-block btn-alt-primary">
                                                <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Sign In
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <!-- END Sign In Form -->
                            </div>
                        </div>
                    </div>
                    <!-- END Sign In Block -->
                </div>
            </div>
        </div>
        <div class="content bg-warning content-full font-size-sm text-muted text-center">
            <strong>CK Publishing 1.0</strong> &copy; <span data-toggle="year-copy"></span>
        </div>
        <!-- END Page Content -->

        <script src="{{ asset('js/oneui.app.js') }}"></script>
        <script src="{{ asset('js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('js/plugins/es6-promise/es6-promise.auto.min.js') }}"></script>
        <script src="{{ asset('js/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
        <script>
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000
            });

            function notify(code, message) {
                Toast.fire({
                    icon: code,
                    title: message,
                });
            }
            $(document).ready( function(){
                $('#forgot_pass').on('click', function(){
                    $('#modal-block-fromleft').modal();
                })

                $('.btn_reset').on('click', function() {
                    var username = $('#reset_email');
                    if(!username.val()){
                        username.addClass('is-invalid');
                        return;
                    }

                    $.ajax({
                        type: 'GET',
                        url: '{{ route('request.reset') }}',
                        data: {
                            reset_email: username.val(),
                        }, 
                        success: function(response) {
                            notify(response.status, response.message);
                        }
                    });
                })
            })
        </script>
    </body>
    </html>
