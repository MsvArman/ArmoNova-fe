<?php $email = $_GET['email'] ?? ''; ?>
<!doctype html>
<html lang="en">
<head>
    <title>Oanoor | otpCode</title>
    <base href="../../../">
    <meta charset="utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <link rel="canonical" href="">
    <link rel="shortcut icon" href="/assets/media/logos/fav.white.ico" />
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
                    <form id="otp-code-form" class="form w-100">
                        <div class="text-center mb-11">
                            <h1 class="text-gray-900 fw-bolder mb-3">Otp Code</h1>
                        </div>
                        <div class="fv-row mb-8">
                            <input type="hidden" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" />

                            <div class="d-flex gap-2 p-10">
                                <input type="text" class="form-control text-center rounded" maxlength="1" id="otp1" autocomplete="off" />
                                <input type="text" class="form-control text-center rounded" maxlength="1" id="otp2" autocomplete="off" />
                                <input type="text" class="form-control text-center rounded" maxlength="1" id="otp3" autocomplete="off" />
                                <input type="text" class="form-control text-center rounded" maxlength="1" id="otp4" autocomplete="off" />
                                <input type="text" class="form-control text-center rounded" maxlength="1" id="otp5" autocomplete="off" />
                            </div>
                        </div>
                        <div class="d-grid mb-10">
                            <button type="submit" id="submit-otp" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">
                                    Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
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

                        <div class="text-gray-500 text-center fw-semibold fs-6">
                            Not a Member yet?
                            <a href="/register" class="link-primary">Sign up</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="w-lg-500px d-flex flex-stack px-10 mx-auto">
                <div class="me-10">
                    <button class="btn btn-flex btn-link btn-color-gray-700 btn-active-color-primary rotate fs-base"
                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start"
                            data-kt-menu-offset="0px, 0px">
                        <img data-kt-element="current-lang-flag" class="w-20px h-20px rounded me-3"
                             src="assets/media/flags/united-states.svg" alt=""/>
                        <span data-kt-element="current-lang-name" class="me-1">English</span>
                        <span class="d-flex flex-center rotate-180">
                            <i class="ki-duotone ki-down fs-5 text-muted m-0"></i>
                        </span>
                    </button>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-4 fs-7"
                         data-kt-menu="true" id="kt_auth_lang_menu">
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link d-flex px-5" data-kt-lang="English">
                                <span class="symbol symbol-20px me-4">
                                    <img data-kt-element="lang-flag" class="rounded-1"
                                         src="assets/media/flags/united-states.svg" alt=""/>
                                </span>
                                <span data-kt-element="lang-name">English</span>
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link d-flex px-5" data-kt-lang="Spanish">
                                <span class="symbol symbol-20px me-4">
                                    <img data-kt-element="lang-flag" class="rounded-1"
                                         src="assets/media/flags/spain.svg" alt=""/>
                                </span>
                                <span data-kt-element="lang-name">Spanish</span>
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link d-flex px-5" data-kt-lang="German">
                                <span class="symbol symbol-20px me-4">
                                    <img data-kt-element="lang-flag" class="rounded-1"
                                         src="assets/media/flags/germany.svg" alt=""/>
                                </span>
                                <span data-kt-element="lang-name">German</span>
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link d-flex px-5" data-kt-lang="Japanese">
                                <span class="symbol symbol-20px me-4">
                                    <img data-kt-element="lang-flag" class="rounded-1"
                                         src="assets/media/flags/japan.svg" alt=""/>
                                </span>
                                <span data-kt-element="lang-name">Japanese</span>
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link d-flex px-5" data-kt-lang="French">
                                <span class="symbol symbol-20px me-4">
                                    <img data-kt-element="lang-flag" class="rounded-1"
                                         src="assets/media/flags/france.svg" alt=""/>
                                </span>
                                <span data-kt-element="lang-name">French</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="d-flex fw-semibold text-primary fs-base gap-5">
                    <a href="#" target="_blank">Terms</a>
                    <a href="#" target="_blank">Plans</a>
                    <a href="#" target="_blank">Contact Us</a>
                </div>
            </div>
        </div>
        <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2"
             style="background-image: url(assets/media/misc/auth-bg.png)">
            <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                <a href="#" class="mb-0 mb-lg-12">
                    <img src="/assets/media/logos/oanor.white.svg" class="h-60px h-lg-75px"/>
                </a>

            </div>
        </div>
    </div>
</div>

<script src="assets/plugins/global/plugins.bundle.js"></script>
<script src="assets/js/scripts.bundle.js"></script>
<script src="assets/js/main.js?v=1.1.8"></script>
<script src="assets/js/authentication/reset-password/otp-code.js"></script>

</body>
</html>