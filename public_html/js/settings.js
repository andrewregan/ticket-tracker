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
                'data-id="<!--data-id-->">' +
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
                    .replace('<!--data-id-->', response.shows[i].id)
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
            var template = '<tr id="<!--id-->" data-id="<!--data-id-->">' +
                $('#accountTemplate').html() + '</tr>';
            var code = template
                .replace('<!--id-->', 'accountTemplate')
                .replace('<!--data-id-->', '0');
            for (i in response.accounts) {
                code += template
                    .replace('<!--id-->', '')
                    .replace('<!--data-id-->', response.accounts[i].id)
                    .replace('<!--email-->', response.accounts[i].email);
            }
            $('#accountTable').html(code);
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
