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
