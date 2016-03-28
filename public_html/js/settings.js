var shows;
var accounts;

$(document).ready(function() {
    loadSettings();

    $('#createShowButton').click(function() {
        $('#editShowModal')
            .modal('show')
            .focus()
            .find('.modal-title')
            .html('Create Show');
        $('#editShowName').val('');
        $('#editShowSeats').val(0);
        $('#editShowPrice').val(10);
        $('#editShowEnable').prop('checked', false);
        $('#editShowSave').data('id', 0);
    });

    $('#editShowSave').click(function() {
        var id = $(this).data('id');

        if (id == '0') {
            if ($('#editShowEnable').prop('checked')) {
                var enabled = 'true';
            } else {
                var enabled = 'false';
            }

            $.post('../php/show-create.php', {
                show_title: $('#editShowName').val(),
                seat_total: $('#editShowSeats').val(),
                seat_cost: $('#editShowPrice').val(),
                enabled: enabled
            }, function(response) {
                var response = jQuery.parseJSON(response);

                if (response.success) {
                    $('#editShowModal').modal('hide');
                    loadSettings();
                } else {
                    $.notify({
                        title: '<b>Save Failed</b>',
                      message: 'An unknown error occured.'
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
        } else {
            if ($('#editShowEnable').prop('checked')) {
                var enabled = 'true';
            } else {
                var enabled = 'false';
            }

            $.post('../php/show-edit.php', {
                id: id,
                show_title: $('#editShowName').val(),
                seat_total: $('#editShowSeats').val(),
                seat_cost: $('#editShowPrice').val(),
                enabled: enabled
            }, function(response) {
                var response = jQuery.parseJSON(response);

                if (response.success) {
                    $('#editShowModal').modal('hide');
                    loadSettings();
                } else {
                    $.notify({
                        title: '<b>Save Failed</b>',
                      message: 'An unknown error occured.'
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
    });

    $('#createAccountButton').click(function() {
        $('#editAccountModal')
            .modal('show')
            .focus()
            .find('.modal-title')
            .html('Create Account');
        $('#editAccountEmail').val('');
        $('#editAccountPassword').val('');
        $('#editAccountSave').data('id', 0);
    });

    $('#deleteShowConfirm').click(function() {
        var id = $(this).data('id');

        $.post('../php/show-delete.php', {
            id: id
        }, function(response) {
            var response = jQuery.parseJSON(response);

            if (response.success) {
                $('#deleteShowModal').modal('hide');
                loadSettings();
            } else {
                $.notify({
                    title: '<b>Delete Failed</b>',
                  message: 'An unknown error occured.'
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

    $('#editAccountSave').click(function() {
        var id = $(this).data('id');

        if (id == '0') {
            $.post('../php/account-create.php', {
                email: $('#editAccountEmail').val(),
                password: $('#editAccountPassword').val()
            }, function(response) {
                var response = jQuery.parseJSON(response);

                if (response.success) {
                    $('#editAccountModal').modal('hide');
                    loadSettings();
                } else {
                    $.notify({
                        title: '<b>Save Failed</b>',
                      message: 'An unknown error occured.'
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
        } else {
            $.post('../php/account-edit.php', {
                id: id,
                email: $('#editAccountEmail').val(),
                password: $('#editAccountPassword').val()
            }, function(response) {
                var response = jQuery.parseJSON(response);

                if (response.success) {
                    $('#editAccountModal').modal('hide');
                    loadSettings();
                } else {
                    $.notify({
                        title: '<b>Save Failed</b>',
                      message: 'An unknown error occured.'
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
    });

    $('#deleteAccountConfirm').click(function() {
        var id = $(this).data('id');

        $.post('../php/account-delete.php', {
            id: id
        }, function(response) {
            var response = jQuery.parseJSON(response);

            if (response.success) {
                $('#deleteAccountModal').modal('hide');
                loadSettings();
            } else {
                $.notify({
                    title: '<b>Delete Failed</b>',
                  message: 'An unknown error occured.'
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
                    .modal('show')
                    .focus()
                    .find('.modal-title')
                    .html('Edit Show');

                $('#editShowName').val(shows[i].show_title);
                $('#editShowSeats').val(shows[i].seat_total);
                $('#editShowPrice').val(shows[i].seat_cost);
                $('#editShowEnable').prop('checked', shows[i].enabled == '1');
                $('#editShowSave').data('id', shows[i].id);
            });

            $('.show-delete-btn').click(function() {
                var i = $(this).parents('tr').data('i');

                $('#deleteShowModal')
                    .modal('show')
                    .focus();

                $('#deleteShowName').html(shows[i].show_title);
                $('#deleteShowSeats').html(shows[i].seat_sales  + ' / ' +
                    response.shows[i].seat_total);
                $('#deleteShowConfirm').data('id', shows[i].id);
            });

            $('.account-edit-btn').click(function() {
                var i = $(this).parents('tr').data('i');

                $('#editAccountModal')
                    .modal('show')
                    .focus()
                    .find('.modal-title')
                    .html('Edit Account');

                $('#editAccountEmail').val(accounts[i].email);
                $('#editAccountPassword').val('');
                $('#editAccountSave').data('id', accounts[i].id);
            });

            $('.account-delete-btn').click(function() {
                var i = $(this).parents('tr').data('i');

                $('#deleteAccountModal')
                    .modal('show')
                    .focus();

                $('#deleteAccountEmail').html(accounts[i].email);
                $('#deleteAccountConfirm').data('id', accounts[i].id);
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
