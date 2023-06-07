<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>APENS-Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
</head>

<body class="hold-transition login-page">
    @if (session('success'))
        <script>
            $(document).ready(function() {
                toastr.success('{{ session('success') }}');
            });
        </script>
    @elseif (session('error'))
        <script>
            $(document).ready(function() {
                toastr.error('{{ session('error') }}');
            });
        </script>
    @endif

    @if ($errors->has('email'))
        <script>
            $(document).ready(function() {
                toastr.error('{{ $errors->first('email') }}');
            });
        </script>
    @endif

    @if ($errors->has('password'))
        <script>
            $(document).ready(function() {
                toastr.error('{{ $errors->first('password') }}');
            });
        </script>
    @endif
    @if ($errors->has('nurse_number'))
        <script>
            $(document).ready(function() {
                toastr.error('{{ $errors->first('nurse_number') }}');
            });
        </script>
    @endif


    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="" class="h1"><b>[APENS]</b></a>
            </div>
            <div class="card-body">

                <p class="login-box-msg">Nurse Attendance</p>

                <form action="{{route('attendance')}}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="nurse_number" class="form-control"  autocomplete="off" placeholder="Nurse_ID" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-id-card"></span>
                            </div>
                        </div>
                    </div>

                    <div class="social-auth-links text-center mt-2 mb-3">
                        <div class="row">
                            <div class="col col-md-6">
                                <button type="submit" name="action" value="signin" class="btn btn-primary float-left"><span class="fa fa-download"></span> Sign
                                    In</button>
                            </div>
                            <div class="col col-md-6">
                                <button type="submit" name="action" value="signout" class="btn btn-danger float-right"><span class="fa fa-upload"></span> Sign
                                    out</button>
                            </div>
                        </div>
                    </div>
                    <div class="float-left">
                        <p><a href="" data-toggle="modal" data-target="#loginModal">Admin Login here
                                &hellip;</a></p>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->

        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
    <!-- Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login here</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('authentication') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="input-group mb-3">
                                <input type="text" name="email" class="form-control" placeholder="Email" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" name="password" class="form-control" placeholder="Password"
                                    required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-primary"><span class="fas fa-sign-in"></span> Sign in</button> --}}
                    <div class="social-auth-links text-center mt-2 mb-3">
                        <button type="submit" class="btn btn-block btn-primary">
                            <i class="fa fa-sign-in"></i> Login
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- //end of modal --}}
    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
</body>

</html>
