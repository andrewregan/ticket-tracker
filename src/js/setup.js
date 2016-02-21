function loadStep() {
    $.post('../php/script/setup-load-content.php', function(response) {
        var response = jQuery.parseJSON(response);

        if (response.success) {
            $('#stepContent').html(response.code);
        }
    });
}

loadStep();
