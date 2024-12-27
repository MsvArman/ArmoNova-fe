window.onload = function () {
    setTheme();
}

function initAxios() {
    axios.defaults.baseURL = 'http://localhost:3333/v1/';
    axios.defaults.timeout = 5000;
    axios.defaults.headers.common['Authorization'] = `Bearer ${getAccessToken()}`;
    axios.defaults.headers.post['Content-Type'] = 'application/json';
    axios.defaults.withCredentials = true;

}

function setTheme() {

    let defaultThemeMode = "light";
    let themeMode;
    if (document.documentElement) {
        if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
        } else {
            if (localStorage.getItem("data-bs-theme") !== null) {
                themeMode = localStorage.getItem("data-bs-theme");
            } else {
                themeMode = defaultThemeMode;
            }
        }
        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }
        document.documentElement.setAttribute("data-bs-theme", themeMode);
        const imageElement = document.querySelector('img[alt="Logo"]');
        // imageElement.src = themeMode === 'light' ? 'assets/media/logos/fav.black.ico' : 'assets/media/logos/fav.white.ico';
    }
}

function getAccessToken() {
    token = getCookie('accessToken');
    return token;

}

function getUserId() {
    user_id = getCookie('user_id');
    return user_id;
}

function setAuthStorage(accessToken, expiresIn, role_id, user_id) {
    setCookie('accessToken', accessToken, null, expiresIn);
    setCookie('expiresIn', expiresIn, null, expiresIn);
    setCookie('role_id', role_id, null, expiresIn);
    setCookie('user_id', user_id, null, expiresIn);
}

function clearAuthStorage() {
    deleteCookie('accessToken');
    deleteCookie('expiresIn');
    deleteCookie('role_id');
    deleteCookie('user_id');
}

function authMeLogin() {
    postRequest(
        '/auth/me',
        {},
        function (response) {
            if (response.status !== 200) {
                return;
            }
            redirectToDashboardIfAuthorized();
        }
    );
}

function authMe() {
    postRequest(
        '/auth/me',
        {},
        function (response) {
            if (response.status !== 200) {
                return;
            }
            const userData = response.data.data;
            const emailVerifiedBadge = document.getElementById('profile-email-verified');
            document.getElementById('profile-username').textContent = userData.username;
            document.getElementById('profile-email').textContent = userData.email;
            if (userData.email_verified) {
                emailVerifiedBadge.textContent = "Verified";
                emailVerifiedBadge.classList.add('badge-light-success');
            } else {
                emailVerifiedBadge.textContent = "Not Verified";
                emailVerifiedBadge.classList.add('badge-light-danger');
            }
            setRoleId();
        },
        function (error) {
            if (error.code === 'ECONNREFUSED' || error.message.includes('Network Error')) {
                window.location.href = '/offline.html';
            }
            redirectToLoginIfUnauthorized(error);
        }
    );
}

function setRoleId() {
    getRequest(
        `/auth/roles/${getUserId()}`,
        function(response){
            localStorage.removeItem('role_id');
            deleteCookie('role_id');
            setCookie('role_id', response.data.data.id, null);
        },
        function(error){
            redirectToLoginIfUnauthorized(error);
        }
    )
}

function redirectToLoginIfUnauthorized(error) {
    if (error?.response?.status === 401) {
        window.location.href = '/login' + window.location.search;
        return true;
    }
    return false;
}

function redirectToDashboardIfAuthorized() {
    window.location.href = '/' + window.location.search;
}

function getRequest(url, thenCallback, catchCallback, finallyCallback) {
    initAxios();
    axios.get(url)
        .then(thenCallback ?? function () {
        })
        .catch(catchCallback ?? function () {
        })
        .finally(finallyCallback ?? function () {
        });
}

function postRequest(url, data, thenCallback, catchCallback, finallyCallback) {
    initAxios();
    axios.post(url, data)
        .then(thenCallback ?? function () {
        })
        .catch(catchCallback ?? function () {
        })
        .finally(finallyCallback ?? function () {
        });
}

function deleteRequest(url, thenCallback, catchCallback, finallyCallback) {
    initAxios();
    axios.delete(url)
        .then(thenCallback ?? function () {
        })
        .catch(catchCallback ?? function () {
        })
        .finally(finallyCallback ?? function () {
        });
}

function logout() {
    clearAuthStorage();
    postRequest('/auth/logout', null, null, null, function () {
        clearAuthStorage();
        window.location.href = '/login' ;
    });
}

function setCookie(name, value, days, milliSeconds = null) {
    let expires = "";

    let date = new Date();

    if (milliSeconds) {

        date.setTime(date.getTime() + milliSeconds);
        expires = "; expires=" + date.toUTCString();
    }
    else if (days) {

        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/; domain=localhost";
}

function getCookie(name) {
    let nameEQ = name + "=";
    let ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) === ' ') {

            c = c.substring(1, c.length);
        }

        if (c.indexOf(nameEQ) === 0) {

            return c.substring(nameEQ.length, c.length);
        }
    }

    return null;
}

function deleteCookie(name) {

    if (!getCookie(name)) {

        return;
    }

    document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;domain=localhost;';
}


function showAlert(type, title, message) {
    const validTypes = ['success', 'error', 'warning', 'info'];
    const icon = validTypes.includes(type) ? type : 'question';
    Swal.fire({
        icon: icon,
        title: title || 'Notification',
        text: message || '',
        confirmButtonText: 'OK'
    });
}

function showConfirmationAlert(title, text, confirmButtonText, cancelButtonText, onConfirm, onCancel) {
    Swal.fire({
        title: title || 'Are you sure?',
        text: text || 'Are you sure you want to proceed?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: confirmButtonText || 'Yes, do it!',
        cancelButtonText: cancelButtonText || 'No, cancel!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            if (typeof onConfirm === 'function') {
                onConfirm();
            }
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            if (typeof onCancel === 'function') {
                onCancel();
            }
        }
    });
}