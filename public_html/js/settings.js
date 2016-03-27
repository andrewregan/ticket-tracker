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
            var template = '<tr id="<!--id-->" data-id="<!--data-id-->">' +
                $('#showTemplate').html() + '</tr>';
            var code = template
                .replace('<!--id-->', 'showTemplate')
                .replace('<!--data-id-->', '0');
            for (i in response.shows) {
                code += template
                    .replace('<!--id-->', '')
                    .replace('<!--data-id-->', i);
            }
            $('#showTable').html(code);

            // generate the accounts panel
            var template = '<tr id="<!--id-->" data-id="<!--data-id-->">' +
                $('#accountTemplate').html() + '</tr>';
            var code = template
                .replace('<!--id-->', 'accountTemplate')
                .replace('<!--data-id-->', '0');
            for (i in response.shows) {
                code += template
                    .replace('<!--id-->', '')
                    .replace('<!--data-id-->', i)
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
