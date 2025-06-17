import AuthSupport from './AuthSupport.js';
const authSupportObj = new AuthSupport();
$(document).ready(function () {

    // *** Login Process ***
    $(document).on('submit', '#login-form', async function (e) {
        e.preventDefault();
        authSupportObj.userLogin('#login-form');
    });
});
