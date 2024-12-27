document.addEventListener("DOMContentLoaded", function() {

    function transitionToStep(step) {
        document.querySelectorAll('.step').forEach(s => s.classList.add('d-none'));
        document.getElementById(step).classList.remove('d-none');
    }

    function startTimer(duration, display) {

        let timer = duration;
        document.getElementById('retry-otp').classList.add('d-none');
        const interval = setInterval(() => {
            const minutes = String(Math.floor(timer / 60)).padStart(2, '0');
            const seconds = String(timer % 60).padStart(2, '0');
            display.textContent = `Remaining Time: ${minutes}:${seconds}`;
            if (--timer < 0) {
                clearInterval(interval);
                display.textContent = "OTP Code Expired!";
                document.getElementById('submit-otp').disabled = true;
                document.getElementById('retry-otp').classList.remove('d-none');
                showAlert('info', 'OTP Code Has Expired', 'The OTP time has expired. If you did not receive the code, You can click on \'Retry OTP\' to request a new code.');
            }
        }, 1000);
    }

    function parseTimeString(timeString) {
        const [minutes, seconds] = timeString.split(':').map(Number);
        return (minutes * 60) + seconds;
    }

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    function onOtpInput(e) {
        let id = e.target.id;
        changeBorderColor();

        switch (id) {
            case 'otp1':
                if (e.target.value.length > 0) {
                    document.getElementById('otp2').focus();
                }
                break;
            case 'otp2':
                if (e.target.value.length > 0) {
                    document.getElementById('otp3').focus();
                } else {
                    document.getElementById('otp1').focus();
                }
                break;
            case 'otp3':
                if (e.target.value.length > 0) {
                    document.getElementById('otp4').focus();
                } else {
                    document.getElementById('otp2').focus();
                }
                break;
            case 'otp4':
                if (e.target.value.length > 0) {
                    document.getElementById('otp5').focus();
                } else {
                    document.getElementById('otp3').focus();
                }
                break;
            case 'otp5':
                if (e.target.value.length < 1) {
                    document.getElementById('otp4').focus();
                }
                break;
            default:
                break;
        }
    }

    document.querySelectorAll('input[id^="otp"]').forEach(input => {
        input.addEventListener('input', onOtpInput);
        input.addEventListener('paste', pasteOtp);
        input.addEventListener('focus', function() {
            this.select();
        });
    });

    function pasteOtp(event) {
        event.preventDefault();
        const clipboardData = event.clipboardData || window.clipboardData;
        const pastedData = clipboardData.getData('Text');

        if (/^\d{5}$/.test(pastedData)) {
            const otpInputs = document.querySelectorAll('input[id^="otp"]');
            otpInputs.forEach((input, index) => {
                input.value = pastedData[index] || '';
            });
            changeBorderColor();
            document.getElementById('otp5').focus();
        } else {
            showAlert("error", "Please enter a valid OTP code!");
        }
    }

    function changeBorderColor() {
        const otpInputs = document.querySelectorAll('input[id^="otp"]');
        otpInputs.forEach(input => {
            if (input.value) {
                input.style.borderColor = 'green';
            } else {
                input.style.borderColor = 'red';
            }
        });
    }

    document.querySelectorAll('input[id^="otp"]').forEach(input => {
        input.addEventListener('keydown', function(event) {
            if (event.key === 'Backspace') {
                const currentId = event.target.id;
                const currentInput = document.getElementById(currentId);
                if (currentInput.value === '') {
                    const prevId = `otp${parseInt(currentId.replace('otp', '')) - 1}`;
                    const prevInput = document.getElementById(prevId);
                    if (prevInput) {
                        prevInput.focus();
                        prevInput.value = '';
                    }
                }
            }
        });
    });

    document.getElementById('submit-email').addEventListener('click', () => {
        const email = document.getElementById('email').value;
        document.getElementById('submit-email').disabled = true;

        if (!validateEmail(email)) {
            showAlert('error', 'Invalid email address');
            document.getElementById('submit-email').disabled = false;
            return;
        }

        const formData = new FormData();
        formData.append('email', email);

        postRequest('auth/forget-password', formData,
            function(response) {
                if (response.status !== 200) {
                    return;
                }

                transitionToStep('step-2');
                document.getElementById('remaining-time').innerText = `Remaining Time: ${response.data.data.remaining_time}`;
                startTimer(parseTimeString(response.data.data.remaining_time), document.getElementById('remaining-time'));
            },
            function(error) {
                if (error.response.status === 404){
                    showAlert('error', 'The email address you entered was not found');
                }else if (error.response.status === 500){
                    showAlert('error', 'Oops! Something went wrong on our end. Please try again later');
                }
                redirectToLoginIfUnauthorized(error);
            }
        );
    });

    document.getElementById('submit-otp').addEventListener('click', () => {
        const email = document.getElementById('email').value;
        const otp = Array.from({ length: 5 }, (_, i) => document.getElementById(`otp${i + 1}`).value).join('');
        const formData = new FormData();
        formData.append('email', email);
        formData.append('otp', otp);

        if (otp.trim() === '') {
            showAlert('error', 'OTP cannot be empty.');
            return;

        } else if (!/^\d+$/.test(otp)) {
            showAlert('error', 'OTP must be a number.');
            return;

        }

        postRequest('auth/verify-otp', formData,
            function(response) {
                if (response.status !== 200) {
                    return;

                }
                showAlert('success', response.data.message);
                transitionToStep('step-3');

            },
            function(error) {
                if (error.response.status === 412) {
                    showAlert('error', 'Verification Failed', 'The OTP you entered is incorrect. Please try again.');

                } else if (error.response.status === 422) {
                    showAlert('error', 'Invalid Input', 'The verification code must contain only numbers. Please try again.');

                } else if (error.response.status === 500) {
                    showAlert('error', 'Oops! Something went wrong on our end. Please try again later');

                } else {
                    redirectToLoginIfUnauthorized(error);

                }
            }
        );
    });

    document.getElementById('submit-password').addEventListener('click', () => {
        const email = document.getElementById('email').value;
        const otp = Array.from({ length: 5 }, (_, i) => document.getElementById(`otp${i + 1}`).value).join('');
        const password = document.getElementById('password').value;
        const passwordConfirmation = document.getElementById('password_confirmation').value;

        if (password.trim() === '') {
            showAlert('error', 'Password cannot be empty');
            return;

        }

        if (passwordConfirmation.trim() === '') {
            showAlert('error', 'Password confirmation cannot be empty');
            return;

        }

        if (password !== passwordConfirmation) {
            showAlert('error', 'Passwords do not match');
            return;

        }

        const passwordPattern = /^(?!.*\s)[A-Za-z\d\W_]{8,32}$/;
        if (!passwordPattern.test(password)) {
            showAlert('error', 'Password must be between 8 to 32 characters long and must not contain any spaces.');
            return;

        }

        const formData = new FormData();
        formData.append('email', email);
        formData.append('otp', otp);
        formData.append('password', password);
        formData.append('password_confirmation', passwordConfirmation);

        postRequest('auth/reset-password', formData,
            function(response) {
                if (response.status !== 200) {
                    return;
                }

                showAlert('success', response.data.message);
                setTimeout(() => {
                    window.location.href = '/login';

                }, 1500);

            },
            function(error) {
                redirectToLoginIfUnauthorized(error);
            }
        );
    });

    document.getElementById('retry-otp').addEventListener('click', () => {
        document.getElementById('submit-otp').disabled = false;
        const email = document.getElementById('email').value;
        const formData = new FormData();
        formData.append('email', email);

        postRequest('auth/retry-otp', formData,
            function(response) {
                if (response.status !== 200) {
                    return;
                }
                const remainingTime = parseTimeString(response.data.data.remaining_time);
                showAlert('success', `${response.data.message}<br>Remaining Time: ${response.data.data.remaining_time}`);
                document.getElementById('remaining-time').innerText = `Remaining Time: ${response.data.data.remaining_time}`;
                startTimer(remainingTime, document.getElementById('remaining-time'));
            },
            function(error) {
                redirectToLoginIfUnauthorized(error);
            }
        );
    });

});
