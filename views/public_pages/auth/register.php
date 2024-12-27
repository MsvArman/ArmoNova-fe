<!doctype html>
<html lang="en">
<head>
    <title>Oanoor | Register</title>
    <base href="../../../">
    <meta charset="utf-8"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="article"/>
    <link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css"/>
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>
</head>
<body>
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
            <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                <div class="w-lg-500px p-10">
                    <form class="form w-100" novalidate="novalidate" id="kt_sign_up_form" action="#">
                        <div class="text-center mb-11">
                            <h1 class="text-gray-900 fw-bolder mb-3">Sign Up</h1>
                        </div>
                        <div class="fv-row mb-8">
                            <input type="text" id="email" placeholder="Email" name="email" autocomplete="off"
                                   class="form-control bg-transparent"/>
                        </div>
                        <div class="fv-row mb-8">
                            <input type="text" placeholder="Username" name="username" autocomplete="off"
                                   class="form-control bg-transparent"/>
                        </div>
                        <div class="fv-row mb-8" data-kt-password-meter="true">
                            <div class="mb-1">
                                <div class="position-relative mb-3">
                                    <div class="d-flex flex-row mb-3">
                                        <input class="form-control bg-transparent" type="password" placeholder="Password"
                                               name="password" id="password" autocomplete="off"/>
                                        <a onclick="copyToClipboard()" class="btn-active-primary m-1 p-1 border rounded d-flex justify-content-center align-items-center">
                                            <i class="ki-outline ki-files-tablet text-gray-700 fs-2"></i>
                                        </a>
                                        <a class="m-1 border rounded btn-active-light-primary text-center align-items-center p-3"
                                                id="generate-password" onclick="generatePassword()">Generate
                                        </a>
                                        <div id="password-error"></div>
                                    </div>
                                    <span>
                                        <label class="checkbox">
                                <input type="checkbox" onclick="showPassword()">
                                <span></span>
                                Show Password
                            </label>
                                    </span>
                                </div>
                            </div>
                            <div class="text-muted">
                                Use 8 or more characters with a mix of letters, numbers, and symbols.
                            </div>
                        </div>
                        <div class="fv-row mb-8">
                            <input placeholder="Repeat Password" name="password_confirmation" id="password_confirmation"
                                   type="password"
                                   autocomplete="off" class="form-control bg-transparent"/>
                        </div>
                        <!-- Terms Checkbox -->
                        <div class="fv-row mb-8">
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="toc" id="toc-checkbox" value="1"/>
                                <span class="form-check-label fw-semibold text-gray-700 fs-base ms-1">
                                I agree to the
                                <a href="#" id="terms-link" class="link-primary" data-bs-toggle="modal" data-bs-target="#termsModal">terms</a>
                                 and conditions.
            </span>
                            </label>
                        </div>
                        <div class="d-grid mb-10">
                            <button type="submit" id="kt_sign_up_submit" class="btn btn-primary">
                                <span class="indicator-label">Sign up</span>
                                <span class="indicator-progress">
                Please wait...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
            </span>
                            </button>
                        </div>
                        <div class="text-gray-500 text-center fw-semibold fs-6">Already have an Account?
                            <a href="/login" class="link-primary fw-semibold">Sign in</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2"
             style="background-image: url(/assets/media/misc/auth-bg.png)">
            <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                <a class="mb-0 mb-lg-12">
                    <img alt="Logo-login" src="/assets/media/logos/oanor.white.svg" class="h-60px h-lg-75px"/>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Terms Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>1. Agreement to Terms</h6>
                <p>By registering on the Oanor website and using our services, you agree to the following terms and
                    conditions. Please read these terms carefully.</p>

                <h6>2. Use of API and WordPress Plugins</h6>
                <p>Users may access our services via API and WordPress plugins. Any unauthorized use, redistribution, or
                    modification of the plugins or APIs is prohibited and may result in service suspension and legal
                    action.</p>

                <h6>3. Intellectual Property</h6>
                <p>All content, plugins, APIs, and documentation are the property of Oanor. Any use of these resources
                    is permitted only with our authorization.</p>

                <h6>4. Payments and Refunds</h6>
                <p>Users are responsible for the payment of the selected service packages. No refunds will be issued
                    after services are used, except in specific cases coordinated with our support team.</p>

                <h6>5. Privacy and Security</h6>
                <p>We are committed to maintaining the privacy and security of users' information. Your personal data
                    will not be sold or shared with third parties under any circumstances.</p>

                <h6>6. Liabilities and Limitations</h6>
                <p>Oanor is not responsible for any damages or technical issues arising from the use of our services or
                    APIs. Users are responsible for properly configuring their systems to integrate with our
                    services.</p>

                <h6>7. Termination of Use</h6>
                <p>We reserve the right to suspend your account at any time if these terms and conditions are
                    violated.</p>

                <h6>8. Changes to Terms</h6>
                <p>Oanor reserves the right to modify these terms and conditions at any time. Any changes will be
                    communicated via email or website notifications.</p>

                <h6>9. Support and Complaints</h6>
                <p>If users require support or have complaints, they can contact us via email or through the support
                    panel on the website.</p>
            </div>
            <div class="modal-footer">
                <button id="accept-btn" type="button" class="btn btn-primary" data-bs-dismiss="modal">I accept</button>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS for Terms Modal -->
<script>
    document.getElementById('accept-btn').addEventListener('click', function () {
        // Check the checkbox
        document.getElementById('toc-checkbox').checked = true;
    });
</script>

<script src="/assets/js/authentication/sign-up/general.js"></script>
<script src="/assets/js/main.js?v=1.1.8"></script>
<script> authMeLogin(); </script>
</body>
</html>
