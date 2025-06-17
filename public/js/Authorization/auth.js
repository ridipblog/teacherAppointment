import AuthSupport from './AuthSupport.js';
const authSupportObj = new AuthSupport();
$(document).ready(function () {

    // *** Login Process ***
    $(document).on('submit', '#login-form', async function (e) {
        try {
            e.preventDefault();
            authSupportObj.userLogin('#login-form');
        } catch (error) {
            Swal.fire("Initialized error execute!");
        }
    });
});
