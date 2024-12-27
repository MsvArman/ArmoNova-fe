"use strict";
var KTSigninGeneral = function () {
    function handleSuccess(data) {
        let accessToken = data.access_token;
        let expiresIn = data.expires_in;
        let role_id = data.roles;
        let user_id = data.user_id;
        setAuthStorage(accessToken, expiresIn, role_id, user_id);
        redirectToDashboardIfAuthorized();

    }
    var form, submitButton, validator;
    return {
        init: function () {
            form = document.querySelector("#login-form");
            submitButton = document.querySelector("#kt_sign_in_submit");
            validator = FormValidation.formValidation(form, {
                fields: {
                    email: {
                        validators: {
                            regexp: {
                                regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                                message: "The value is not a valid email address"

                            },
                            notEmpty: {
                                message: "Email address is required"

                            }

                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: "The password is required"

                            }

                        }

                    }

                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            });

            window.addEventListener('pageshow', function (event) {
                if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
                    submitButton.removeAttribute("data-kt-indicator");
                    submitButton.disabled = false;
                }
            });

            submitButton.addEventListener("click", function (event) {
                event.preventDefault();

                validator.validate().then(function (status) {

                    if (status === 'Valid') {
                        submitButton.setAttribute("data-kt-indicator", "on");
                        submitButton.disabled = true;

                        setTimeout(function () {
                            const formData = new FormData(form);
                            const formJSON = {};

                            formData.forEach((value, key) => formJSON[key] = value);
                            postRequest(
                                '/auth/login',
                                formJSON,
                                function (response) {

                                    if (response.data.status !== 'Successful'){
                                        showAlert('error', response.data.message);
                                        return;

                                    }

                                    showAlert('success', response.data.message );
                                    setTimeout(() => {
                                        handleSuccess(response.data.data);
                                    }, 1500);

                                },
                                function (error) {

                                    if (error.response.status === 422){
                                        showAlert('error', 'password must be between 8 to 32 characters and only contains alphanumeric, dash, underline and special characters');
                                        submitButton.disabled = false;

                                    }else if (error.response.status === 404){
                                        showAlert('error', 'User not found');
                                        submitButton.disabled = false;

                                    }else if (error.response.status === 412){
                                        showAlert('error', 'Your email or password is wrong!');
                                        submitButton.disabled = false;

                                    }else{
                                        showAlert('error', error.response.message);
                                    }

                                }
                            );
                        }, 150);

                    } else {
                        showAlert('error','Error', 'Sorry,looks like there are some errors detected, please try again.');

                    }

                });
            });
        }
    };
}();

KTUtil.onDOMContentLoaded(function () {
    KTSigninGeneral.init();
});