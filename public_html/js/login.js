$('#loginButton').click(function() {
    $(this).attr('disabled', true);

    $.post('../php/login-create.php', {
            email: $('#loginEmail').val(),
            password: $('#loginPassword').val()
        }, function(response) {
        var response = jQuery.parseJSON(response);

        if (response.success) {
            
        }

        $('#loginButton').attr('disabled', false);
    });
});
