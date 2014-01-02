var create_url = base + 'installer/CreateInstaller';

function onCreateInstaller() {
    var module = $('#ModuleSelection').val();
    var installerType = $('#InstallerTypeSelection').val();

    if (module === '') {
        alert('Please select a module to create installer');
    } else if (installerType === '') {
        alert('Please select an installation type');
    } else {
        $.ajax({
            url: create_url,
            type: 'POST',
            beforeSend: beforeAjaxStart('bundle_container'),
            dataType: "json",
            data: $('#frm_bundle').serialize() + "&tables=" + JSON.stringify(checkTables()),
            success: function(msg) {
                afterAjaxEnd('bundle_container');
                var message = msg.message;
                showNotification(message);
            },
            error: function(msg) {
                afterAjaxEnd('bundle_container');
                showNotification('A network error occur. Please try again');
            }
        });
        return false;
    }
}

function checkTables() {
    var checked_tables = new Array();
    
    $('input[name=checkTables]').each(function() {
        var val = $(this).val();
        if ($(this).attr('checked')) {
            checked_tables.push(val);
        }
    });

    return $.unique(checked_tables);
}