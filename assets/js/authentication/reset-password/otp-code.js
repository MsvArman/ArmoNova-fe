document.addEventListener("DOMContentLoaded", function() {

    setTimeout(() => {
        document.getElementById('retry-otp').classList.remove('d-none');

    }, 285000);


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

    function onOtpInput(e) {
        const id = e.target.id;

        changeBorderColor();

        const nextId = `otp${parseInt(id.replace('otp', '')) + 1}`;
        const prevId = `otp${parseInt(id.replace('otp', '')) - 1}`;

        if (e.target.value.length > 0) {
            document.getElementById(nextId)?.focus();
        } else if (e.target.value.length < 1) {
            document.getElementById(prevId)?.focus();
        }
    }

    function pasteOtp(event) {
        event.preventDefault();
        const pastedData = (event.clipboardData || window.clipboardData).getData('Text');

        if (/^\d{5}$/.test(pastedData)) {
            document.querySelectorAll('input[id^="otp"]').forEach((input, index) => {
                input.value = pastedData[index] || '';
            });
            changeBorderColor();
            document.getElementById('otp5').focus();
        } else {
            showAlert("error", "Please enter a valid OTP code!");
        }
    }

    function changeBorderColor() {
        document.querySelectorAll('input[id^="otp"]').forEach(input => {
            input.style.borderColor = input.value ? 'green' : 'red';
        });
    }

    document.querySelectorAll('input[id^="otp"]').forEach(input => {
        input.addEventListener('input', onOtpInput);
        input.addEventListener('paste', pasteOtp);
        input.addEventListener('focus', function() {
            this.select();
        });
        input.addEventListener('keydown', function(event) {
            if (event.key === 'Backspace' && input.value === '') {
                const prevId = `otp${parseInt(input.id.replace('otp', '')) - 1}`;
                document.getElementById(prevId)?.focus();
            }
        });
    });


    document.getElementById('submit-otp').addEventListener('click', (event) => {
        event.preventDefault();
        const email = document.getElementById('email').value;
        const otp = Array.from({ length: 5 }, (_, i) => document.getElementById(`otp${i + 1}`).value).join('');

        if (!otp.trim()) {
            showAlert('error', 'OTP cannot be empty!');
            return;

        }

        if (!/^\d{5}$/.test(otp)) {
            showAlert('error', 'OTP must be a 5-digit number!');
            return;

        }

        const formData = new FormData();
        formData.append('email', email);
        formData.append('otp', otp);

        postRequest(
            'auth/verify-otp',
            formData,
            function(response) {
                if (response.status === 200) {
                    showAlert('success', response.data.message);
                    setTimeout(() => {
                        window.location.href = '/login';

                    }, 1500);

                }
            },
            function (error){

                if (error.response.status === 422){
                    showAlert('error', 'Validation Error');

                }
                else if (error.response.status === 404) {
                    showAlert('error', 'Not Found', 'Email not found. Please check and try again');

                }
                else if (error.response.status ===  412) {
                    showAlert('error', 'OTP Code Error', 'The OTP code you entered is incorrect. Please try again');

                }
                else if (error.response.status === 500) {
                    showAlert('error', 'Oops! Something went wrong. Please try again later.');

                }
                redirectToLoginIfUnauthorized(error);

            }
        );

    });


    document.getElementById('retry-otp').addEventListener('click', () => {
        const email = document.getElementById('email').value;
        const formData = new FormData();
        formData.append('email', email);

        postRequest(
            'auth/retry-otp',
            formData,
            function(response) {
                if (response.status === 200) {
                    showAlert('success', `${response.data.message}<br>Remaining Time: ${response.data.data.remaining_time}`);
                    startTimer(parseTimeString(response.data.data.remaining_time), document.getElementById('remaining-time'));

                }

            },
            function (error) {

                if (error.response.status === 422){
                    showAlert('error', 'Validation Error');

                }
                else if (error.response.status === 404) {
                    showAlert('error', 'Not Found', 'Email not found. Please check and try again');

                }
                else if (error.response.status === 500) {
                    showAlert('error', 'Oops! Something went wrong. Please try again later.');

                }
                redirectToLoginIfUnauthorized(error);

            }
        );

    });

});