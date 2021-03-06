$(document).ready(function() {
    $('#loginButton').click(function() {
        sendLoginInfo();
    });

    $('#loginPassword').keypress(function(e) {
        if (e.which == 13) {
            console.log('yay');
            sendLoginInfo();
            return false;
        }
    });
});

function sendLoginInfo() {
    // do not send empty login information to server
    if ($('#loginEmail').val() == '' || $('#loginPassword').val() == '') {
        $.notify({
            title: '<b>Missing Field</b>',
            message: 'There are one or more inputs missing.'
        },{
            type: 'warning',
            newest_on_top: true,
            placement: {
                from: "top",
                align: "center"
            }
        });

        return false;
    }

    // disable the login button and send request
    $(this).attr('disabled', true);
    $.post('../php/login-create.php', {
            email: $('#loginEmail').val(),
            password: $('#loginPassword').val()
        }, function(response) {
        var response = jQuery.parseJSON(response);

        if (response.success) {
            $.notify({
                title: '<b>Success</b>',
            	message: 'You have now been logged in successfully!'
            },{
            	type: 'success',
                newest_on_top: true,
                placement: {
            		from: "top",
            		align: "center"
            	}
            });
            setTimeout(function() {
                window.location.reload(true);
            }, 1500);
        } else {
            if (response.error == 'too_many_attempts') {
                $.notify({
                    title: '<b>Too Many Attempts</b>',
                	message: 'There have been too many failed login attempts from this IP address, please wait one hour and try again.'
                },{
                	type: 'danger',
                    newest_on_top: true,
                    placement: {
                		from: "top",
                		align: "center"
                	}
                });
            } else {
                $.notify({
                    title: '<b>Login Failed</b>',
                	message: 'You have entered incorrect login information, please try again.'
                },{
                	type: 'warning',
                    newest_on_top: true,
                    placement: {
                		from: "top",
                		align: "center"
                	}
                });
            }
        }

        $('#loginButton').attr('disabled', false);
    });
}
