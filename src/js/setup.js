var step = 0;

function attachEventHandlers() {
    $('#nextStep').click(function() {
        nextStep();
    });
    $('#resetSetup').click(function() {
        resetSetup();
    });
}

function loadStep() {
    $.post('../php/script/setup-load-content.php', function(response) {
        var response = jQuery.parseJSON(response);

        if (response.success) {
            $('#stepContent').html(response.code);
            $('#stepTitle').html(response.title);

            step = response.step;

            attachEventHandlers();
        }
    });
}

function nextStep() {
    var data = {};

    $('input').each(function() {
        // get name and value for each input
        var name = $(this).attr('id');
        var value = $(this).val();

        // check if this is an input we care about
        if (name.substring(0, 5) == 'input') {
            // set name to lowercase
            name = name.substring(5).toLowerCase();

            // add value onto object
            data[name] = value;
        }
    });

    // convert data to json string
    data = JSON.stringify(data);

    $.post('../php/script/setup-run-step.php', {
        data: data,
        step: step
    }, function(response) {
        var response = jQuery.parseJSON(response);

        if (response.success) {
            if (response.next_step == 4) {
                window.location = '../';
            } else {
                loadStep();
            }
        } else {
            loadStep();
        }

        $('#stepWarning').html(response.warning);
    });
}

function resetSetup() {
    $.post('../php/script/setup-reset.php', function(response) {
        var response = jQuery.parseJSON(response);

        if (response.success) {
            loadStep();
            $('#stepWarning').html('');
        }
    });
}

loadStep();
