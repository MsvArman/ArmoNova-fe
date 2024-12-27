<!doctype html>
<html lang="en">
<head>
    <title>Oanoor | sign in</title>
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
</head>
<body>
<div class="d-flex flex-column flex-root" id="kt_app_root">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <div class="w-lg-500px p-10">
                        <form id="login-form" class="form w-100" novalidate="novalidate">
                            <div class="text-center mb-11">
                                <h1 class="text-gray-900 fw-bolder mb-3">Log in</h1>
                            </div>
                            <div class="fv-row mb-8">
                                <input type="text" placeholder="Email" name="email_or_username" autocomplete="off"
                                       class="form-control bg-transparent"/>
                            </div>
                            <div class="fv-row mb-3">
                                <input type="password" placeholder="Password" name="password" autocomplete="off"
                                       class="form-control bg-transparent"/>
                            </div>
                            <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                <div></div>
                                <a href="/forget-password" class="link-primary">
                                    Forgot Password ?
                                </a>
                            </div>
                            <div class="d-grid mb-10">
                                <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                    log in
                                </button>
                            </div>
                            <div class="text-gray-500 text-center fw-semibold fs-6">
                                Not a Member yet?
                                <a href="/register" class="link-primary">Sign up</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2"
                 style="background-image: url(/assets/media/misc/auth-bg.png)">
                <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                    <a href="#" class="mb-0 mb-lg-12">
                    <img alt="Logo-login" src="/assets/media/logos/oanor.white.svg" class="h-60px h-lg-75px"/>
                    </a>
                </div>
            </div>
        </div>
    </div>

<script src="assets/plugins/global/plugins.bundle.js"></script>
<script src="assets/js/scripts.bundle.js"></script>
<script src="assets/js/axios.min.js"></script>
<script src="assets/js/authentication/sign-in/general.js"></script>
<script src="assets/js/main.js?v=1.1.8"></script>
<script> authMeLogin(); </script>

</body>
</html>