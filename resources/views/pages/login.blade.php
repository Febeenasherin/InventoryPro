<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Login | InventoryPro</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500"
        rel="stylesheet" />
    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />
    <link id="sleek-css" rel="stylesheet" href="assets/css/sleek.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <link href="assets/img/favicon.png" rel="shortcut icon" />
    <script src="assets/plugins/nprogress/nprogress.js"></script>
</head>

<body class="" id="body">
    <div class="container d-flex align-items-center justify-content-center vh-100">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-10">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="app-brand">
                            <a href="/index.html">
                                <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg"
                                    preserveAspectRatio="xMidYMid" width="30" height="33" viewBox="0 0 30 33">
                                    <g fill="none" fill-rule="evenodd">
                                        <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
                                        <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                                    </g>
                                </svg>

                                <span class="brand-name">InventoryPro</span>
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-3">
                        <h4 class="text-dark mb-2">Sign In</h4>

                        <div class="alert alert-danger invalid-msg" role="alert">
                        </div>

                        <form class="authForm">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12 mb-4">
                                    <input type="text" class="form-control input-lg email" id="email"
                                        name="email" placeholder="Username">
                                </div>

                                <div class="form-group col-md-12 ">
                                    <input type="password" class="form-control input-lg password" name="password"
                                        id="password" placeholder="Password">
                                </div>

                                <div class="col-md-12">
                                    <div class="d-flex my-2 justify-content-between">
                                        <div class="d-inline-block mr-3">
                                            <label class="control control-checkbox">Remember me
                                                <input type="checkbox" name="remember_me">
                                                <div class="control-indicator"></div>
                                            </label>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-lg btn-primary btn-block mb-4">Sign
                                        In</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Javascript -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="assets/js/sleek.js"></script>
    <link href="assets/options/optionswitch.css" rel="stylesheet">
    <script src="assets/options/optionswitcher.js"></script>
    <script>
        $(document).ready(function() {
            $(".invalid-msg").hide();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $('.authForm').on('submit', function(e) {
                e.preventDefault();
                $(".invalid-msg").hide();
                var formData = new FormData(this);
                $.ajax({
                    url: '{{ route('auth') }}',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        $(".invalid-msg").hide();
                        toastr.options = {
                            "positionClass": "toast-top-right",
                            "timeOut": "3000",
                            "extendedTimeOut": "1000",
                            "closeButton": true,
                        };
                        toastr.success(response.message);
                        setTimeout(function() {
                            window.location.href = response.redirect_location;
                        }, 1500);
                    },
                    error: function(response) {
                        console.log(response);
                        $(".invalid-msg").show();
                        $(".invalid-msg").html(
                            '<i class="mdi mdi-alert mr-1"></i>Invalid Username or Password'
                        );
                    }
                });
            });
        });
    </script>
</body>

</html>
