function generatePassword() {
    const length = 12;
    const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+[]{}|;:,.<>?";
    let password = "";
    const lowerCase = "abcdefghijklmnopqrstuvwxyz";
    const upperCase = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    const digits = "0123456789";
    const specialChars = "!@#$%^&*()_+[]{}|;:,.<>?";

    password += lowerCase.charAt(Math.floor(Math.random() * lowerCase.length));
    password += upperCase.charAt(Math.floor(Math.random() * upperCase.length));
    password += digits.charAt(Math.floor(Math.random() * digits.length));
    password += specialChars.charAt(Math.floor(Math.random() * specialChars.length));

    for (let i = password.length; i < length; i++) {
        const randomIndex = Math.floor(Math.random() * charset.length);
        password += charset[randomIndex];
    }

    password = password.split('').sort(() => Math.random() - 0.5).join('');

    document.getElementById('password').value = password;
    document.getElementById('password_confirmation').value = password;
}

function showPassword() {
    let x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

function copyToClipboard() {
    let copyText = document.getElementById("password");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(copyText.value);
    showAlert("success","Copied the text: " + copyText.value)
}

const KTSignupGeneral = (() => {
    let formElement, submitButton, passwordMeterInstance, validation;

    const validateUrl = (url) => {
        try {
            new URL(url);
            return true;
        } catch (e) {
            return false;
        }
    };

    const passwordCallback = () => {
        return passwordMeterInstance.getScore() > 30;
    };

    const initValidation = (fieldsConfig) => {
        return FormValidation.formValidation(formElement, {
            fields: fieldsConfig,
            plugins: {
                trigger: new FormValidation.plugins.Trigger({ event: { password: false } }),
                bootstrap: new FormValidation.plugins.Bootstrap5({
                    rowSelector: ".fv-row",
                    eleInvalidClass: "",
                    eleValidClass: ""
                })
            }
        });
    };

    const handleFormSubmit = async (event) => {
        event.preventDefault();
        await validation.revalidateField("password");

        const validationResult = await validation.validate();
        if (validationResult === "Valid") {
            submitButton.setAttribute("data-kt-indicator", "on");
            submitButton.disabled = true;

            postRequest('auth/signup', new FormData(formElement),
                (response) => {
                    showAlert('success', 'Success', "Registration successful! You will be redirected to the email verification page");
                    const emailValue = formElement.querySelector('input[name="email"]').value;
                    setTimeout(() => {
                        window.location.href = `/verify-otp?email=${emailValue}`;
                    }, 1700);

                },
                (error) => {
                    const errorMessage = error.response?.data?.data?.username ||
                        error.response?.data?.data?.password ||
                        error.response?.data?.data?.email ||
                        "An error occurred.";
                    showAlert('error', 'Error', errorMessage);
                    submitButton.setAttribute("data-kt-indicator", "off");
                    submitButton.disabled = false;

                    redirectToLoginIfUnauthorized(error);
                }
            );
        } else {
            showAlert('error', 'Validation Error', "Sorry, looks like there are some errors detected, please try again.");
        }
    };

    const initFormValidation = () => {
        const fieldsConfig = {
            email: {
                validators: {
                    regexp: {
                        regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                        message: "The value is not a valid email address"
                    },
                    notEmpty: { message: "Email address is required" }
                }
            },
            username: {
                validators: {
                    notEmpty: { message: "Username is required" },
                    regexp: {
                        regexp: /^[A-Za-z0-9]+$/,
                        message: "Username can only contain letters and numbers."
                    },
                    stringLength: {
                        min: 3,
                        message: "Username must be at least 3 characters long."
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: { message: "The password is required" },
                    regexp: {
                        regexp: /^(?!.*\s)[A-Za-z\d\W_]{8,32}$/,
                        message: "Password must be between 8 to 32 characters long and must not contain any spaces."
                    }
                }
            },
            "confirm-password": {
                validators: {
                    notEmpty: { message: "The password confirmation is required" },
                    identical: {
                        compare: () => formElement.querySelector('[name="password"]').value,
                        message: "The password and its confirm are not the same"
                    }
                }
            },
            toc: {
                validators: { notEmpty: { message: "You must accept the terms and conditions" } }
            }
        };

        validation = initValidation(fieldsConfig);

        formElement.querySelector('input[name="password"]').addEventListener("input", function () {
            if (this.value.length > 0) validation.updateFieldStatus("password", "NotValidated");
        });
    };

    return {
        init: function () {
            formElement = document.querySelector("#kt_sign_up_form");
            submitButton = document.querySelector("#kt_sign_up_submit");
            passwordMeterInstance = KTPasswordMeter.getInstance(formElement.querySelector('[data-kt-password-meter="true"]'));

            if (!validateUrl(submitButton.closest("form").getAttribute("action"))) {
                initFormValidation();
            }

            submitButton.addEventListener("click", handleFormSubmit);
        }
    };
})();

KTUtil.onDOMContentLoaded(() => {
    KTSignupGeneral.init();
});