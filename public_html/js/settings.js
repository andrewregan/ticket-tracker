var shows;
var accounts;

$(document).ready(function() {
    loadSettings();
});

function loadSettings() {
    $.post('../php/settings-load-content.php', function(response) {
        var response = jQuery.parseJSON(response);

        if (response.success) {
            // populate the settings panel
            $('#settingsTitle').val(response.site_title);
            $('#settingsTheme').val(response.site_theme);
            $('#settingsDisableSite').prop(
                'checked',
                (response.site_disable == 'true')
            );

            // generate the shows panel
            var template = '<tr class="<!--class-->" ' +
                'data-i="<!--data-id-->">' +
                $('#showTemplate').html() + '</tr>';
            var code = '<tr id="showTemplate">' +
                $('#showTemplate').html() + '</tr>';
            for (i in response.shows) {
                if (response.shows[i].enabled == '0') {
                    hidden = 'danger';
                } else {
                    hidden = '';
                }

                code += template
                    .replace('<!--id-->', '')
                    .replace('<!--class-->', hidden)
                    .replace('<!--data-id-->', i)
                    .replace('<!--name-->', response.shows[i].show_title)
                    .replace(
                        '<!--seats-->',
                        response.shows[i].seat_sales + ' / ' +
                        response.shows[i].seat_total
                    )
                    .replace('<!--price-->', response.shows[i].seat_cost);
            }
            $('#showTable').html(code);

            // generate the accounts panel
            var template = '<tr id="<!--id-->" data-i="<!--data-id-->">' +
                $('#accountTemplate').html() + '</tr>';
            var code = template
                .replace('<!--id-->', 'accountTemplate')
                .replace('<!--data-id-->', '0');
            for (i in response.accounts) {
                code += template
                    .replace('<!--id-->', '')
                    .replace('<!--data-id-->', i)
                    .replace('<!--email-->', response.accounts[i].email);
            }
            $('#accountTable').html(code);

            // store information in variables for later use
            shows = response.shows;
            accounts = response.accounts;

            $('.show-edit-btn').click(function() {
                var i = $(this).parents('tr').data('i');

                $('#editShowModal')
                    .modal({
                        show: true
                    })
                    .focus()
                    .find('.modal-title')
                    .html('Edit Show');

                $('#editShowName').val(shows[i].show_title);
                $('#editShowSeats').val(shows[i].seat_total);
                $('#editShowPrice').val(shows[i].seat_cost);
                $('#editShowEnabled').prop('checked', shows[i].enabled == '1');
                $('#editShowSave').data('id', shows[i].id);
            });

            $('#createShowButton').click(function() {
                $('#editShowModal')
                    .modal({
                        show: true
                    })
                    .focus()
                    .find('.modal-title')
                    .html('Create Show');
                $('#editShowName').val('');
                $('#editShowSeats').val(0);
                $('#editShowPrice').val(10);
                $('#editShowEnabled').prop('checked', false);
                $('#editShowSave').data('id', 0);
            });

            $('#editShowSave').click(function() {
                if ($(this).data('id') == '0') {
                    $.post('../php/changeme.php', {

                    }, function(response) {
                        var response = jQuery.parseJSON(response);

                        if (response.success) {
                            $('#editShowModal').modal({show: false});
                        }
                    });
                } else {

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
}
