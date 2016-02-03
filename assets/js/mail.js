$(function () {

    // Get the form.
    var form = $('#signup-form');

    var formMessages = $('#form-messages');

    // Get the email div.
    

    // Set up an event listener for the contact form.
    $(form).submit(function (e) {
            // $('.input-btn').click(function(e) {
            // Stop the browser from submitting the form.
            e.preventDefault();
        var email = $('#email').val();
console.log('email value: '+email);

            // Submit the form using AJAX.
            $.ajax({
                    type: 'POST',
                    url: $(form).attr('action'),
                    data: {
                        email:email
                    }
                })
                .done(function (response) {
                    // Make sure that the formMessages div has the 'success' class.
                    $(formMessages).removeClass('error');
                    $(formMessages).addClass('success');

                    // Clear the form.
                    $('#email').val('');
                })
                .fail(function (data) {
                        // Make sure that the formMessages div has the 'error' class.
                        $(formMessages).removeClass('success');
                        $(formMessages).addClass('error');



                    })
                });

    });

