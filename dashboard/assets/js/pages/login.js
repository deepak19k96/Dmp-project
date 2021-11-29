$(function () {
    'use strict';

    var pageLoginForm = $('.auth-login-form');

    // jQuery Validation
    // --------------------------------------------------------------------
    if (pageLoginForm.length) {
        pageLoginForm.validate({
            rules: {
                'login-email': {
                    required: true,
                    // email: true
                },
                'login-password': {
                    required: true
                }
            },
            submitHandler: function(form) {
              var email =  $('#login-email').val();
              var pass =  $('#login-password').val();
              var result = $.base64.encode(email + ':' + pass);

                $.ajax({
                    type: "GET",
                    url: "/appapi/user/emailogin/" + result,
                    // data: $(form).serialize(),
                    timeout: 3000,
                    success: function() {
                        window.location = "/dashboard/";
                    },
                    error: function() {
                        $('.loginerror').html('Incorrect Login');
                        alert('failed');
                    }
                });
                return false;
            }
        });
    }
});
