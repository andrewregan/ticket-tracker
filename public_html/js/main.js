var shows;

$(document).ready(function() {
    $('#reserveSeats').change(function() {
        updateTicketCost();
    });

    $('#reserveShow').change(function() {
        updateTicketCost();
    });

    $('#reserveTicketButton').click(function() {
        // show the modal
        $('#reserveTicketModal')
            .modal('show')
            .focus();

        // reset all values in modal
        $('#reserveFirstName').val('');
        $('#reserveLastName').val('');
        $('#reservePhone').val('');
        $('#reserveEmail').val('');
        $('#reserveSeats').val(1);
        $('#reserveComments').val('');

        // load the list of shows
        $.post('../php/orders-load-content.php', function(response) {
            var response = jQuery.parseJSON(response);

            if (response.success) {
                // rebuild the show dropdown menu
                var code = '';
                var optionCode = '<option value="<!--id-->" data-i="<!--data-->"><!--name--></option>';
                for (i in response.shows) {
                    code += optionCode
                        .replace('<!--id-->', response.shows[i].id)
                        .replace('<!--name-->', response.shows[i].show_title)
                        .replace('<!--data-->', i);
                }
                $('#reserveShow').html(code);

                // store the show data for later use
                shows = response.shows;

                // update the ticket cost and inputs
                updateTicketCost();
            } else {
                $.notify({
                    title: '<b>Load Failed</b>',
                  message: 'An unknown error occured, failed to load content.'
                },{
                  type: 'danger',
                    newest_on_top: true,
                    placement: {
                    from: "top",
                    align: "center"
                  }
                });
            }
        });
    });

    $('#reserveTicketSave').click(function() {
        var firstName = $('#reserveFirstName').val();
        var lastName = $('#reserveLastName').val();
        var phone = $('#reservePhone').val();
        var email = $('#reserveEmail').val();
        var showId = $('#reserveShow').val();
        var seatNum = $('#reserveSeats').val();
        var comments = $('#reserveComments').val();

        // send the ticket order
        $.post('../php/orders-create.php', {
            first_name: firstName,
            last_name: lastName,
            phone: phone,
            email: email,
            show_id: showId,
            seat_num: seatNum,
            comments: comments
        }, function(response) {
            var response = jQuery.parseJSON(response);

            if (response.success) {
                // hide the modal and display a message
                $('#reserveTicketModal').modal('hide');

                var seats = $('#reserveSeats').val();
                var id = $('#reserveShow').val();
                var i = $('#reserveShow').find('option[value="' + id + '"]').data('i');

                $.notify({
                    title: '<b>Success</b>',
                  message: $('#reserveSeats').val() + ' tickets have been ordered for "' + shows[i].show_title + '".'
                },{
                  type: 'success',
                    newest_on_top: true,
                    placement: {
                    from: "top",
                    align: "center"
                  }
                });
            } else {
                $.notify({
                    title: '<b>Load Failed</b>',
                  message: 'An unknown error occured, failed to load content.'
                },{
                  type: 'danger',
                    newest_on_top: true,
                    placement: {
                    from: "top",
                    align: "center"
                  }
                });
            }
        });
    });
});

function updateTicketCost() {
    var seats = $('#reserveSeats').val();
    var id = $('#reserveShow').val();
    var i = $('#reserveShow').find('option[value="' + id + '"]').data('i');
    var seatsLeft = shows[i].seat_total - shows[i].seat_sales;

    if (seats > seatsLeft) {
        seats = seatsLeft;
    }

    $('#reserveSeats').prop('max', seatsLeft);
    $('#reserveSeats').val(seats);
    $('#reserveSeatsCost').val('$' + (shows[i].seat_cost * seats));
}
