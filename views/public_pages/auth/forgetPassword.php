<!doctype html>
<html lang="en">
<head>
    <title>Oanoor | Forget Password</title>
    <base href="../../../">
    <meta charset="utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <link rel="canonical" href="">
    <link rel="shortcut icon" href="assets/media/logos/fav.white.ico" />
    <link rel="stylesheet" href="">
    <link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

    <style>
        .link-primary {
            font-weight: bold;
            position: relative;
            text-decoration: none;
        }

        .hover-icon::after {
            content: '🔄';
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .hover-icon:hover::after {
            opacity: 1;
        }
    </style>

</head>
<body>
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
            <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                <div class="w-lg-500px p-10">
                    <form id="forget-password-form" class="form w-100" novalidate="novalidate">
                        <div class="text-center mb-11">
                            <h1 class="text-gray-900 fw-bolder mb-3">Forget Password</h1>
                        </div>
                        <div id="step-1" class="step">
                            <div class="fv-row mb-8">
                                <input type="text" placeholder="Email" name="email" id="email" autocomplete="off" class="form-control bg-transparent"/>
                            </div>
                            <div class="d-grid mb-10">
                                <button type="button" id="submit-email" class="btn btn-primary">
                                    <span class="indicator-label">Submit</span>
                                    <span class="indicator-progress">Please wait...<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                        </div>
                        <div id="step-2" class="step d-none">
                            <div class="fv-row mb-8">
                                <div class="container mt-5">
                                    <div class="row justify-content-center">
                                        <div class="col-auto">
                                            <div class="d-flex gap-2 p-10">
                                                <input type="text" class="form-control text-center rounded" maxlength="1" oninput="onOtpInput(event, 'otp1', 'otp2')" id="otp1" autocomplete="off" />
                                                <input type="text" class="form-control text-center rounded" maxlength="1" oninput="onOtpInput(event, 'otp2', 'otp3')" id="otp2" autocomplete="off" />
                                                <input type="text" class="form-control text-center rounded" maxlength="1" oninput="onOtpInput(event, 'otp3', 'otp4')" id="otp3" autocomplete="off" />
                                                <input type="text" class="form-control text-center rounded" maxlength="1" oninput="onOtpInput(event, 'otp4', 'otp5')" id="otp4" autocomplete="off" />
                                                <input type="text" class="form-control text-center rounded" maxlength="1" oninput="onOtpInput(event, 'otp5', null)" id="otp5" autocomplete="off" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid mb-10">
                                <button type="button" id="submit-otp" class="btn btn-primary">
                                    <span class="indicator-label">Verify OTP</span>
                                    <span class="indicator-progress">Please wait...<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                            <div class="text-center mt-3">
                                <span id="remaining-time" class="text-danger font-weight-bold"></span>
                            </div>
                            <div class="text-gray-500 text-center fw-semibold fs-6 mt-3">
                                <span id="retry-otp" class="link-primary hover-icon d-none" title="Click to resend OTP">
                                    Retry OTP
                                </span>
                            </div>
                        </div>
                        <div id="step-3" class="step d-none">
                            <div class="fv-row mb-8">
                                <input type="password" placeholder="New Password" name="password" id="password" autocomplete="off" class="form-control bg-transparent"/>
                            </div>
                            <div class="fv-row mb-8">
                                <input type="password" placeholder="Confirm Password" name="password_confirmation" id="password_confirmation" autocomplete="off" class="form-control bg-transparent"/>
                            </div>
                            <div class="d-grid mb-10">
                                <button type="button" id="submit-password" class="btn btn-primary">
                                    <span class="indicator-label">Reset Password</span>
                                    <span class="indicator-progress">Please wait...<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url(/assets/media/misc/auth-bg.png)">
            <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                <a href="#" class="mb-0 mb-lg-12">
                    <img alt="Logo-login" src="assets/media/logos/oanor.white.svg" class="h-60px h-lg-75px"/>
                </a>
            </div>
        </div>
        </div>
    </div>
</div>
<script src="assets/plugins/global/plugins.bundle.js"></script>
<script src="assets/js/scripts.bundle.js"></script>
<script src="assets/js/axios.min.js"></script>
<script src="assets/js/authentication/reset-password/forget-password.js?ver=1.0.1"></script>
<script src="assets/js/main.js?v=1.1.8"></script>
</body>
</html>