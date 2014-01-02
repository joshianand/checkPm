function OnPesonalInfoSave() {
    $.ajax({
        url: base + 'profile/UpdatePersonalData',
        type: 'POST',
        beforeSend: beforeAjaxStart('profile_container'),
        dataType: "json",
        traditional: true,
        data: $('#frm_profile').serialize(),
        success: function(msg) {
            afterAjaxEnd('profile_container');
            var flag = parseFloat(msg.flag);
            var message = msg.message;
            showNotification(message);
        },
        error: function(msg) {
            afterAjaxEnd('profile_container');
            showNotification('A network error occur. Please try again');
        }
    });

    return false;
}

function OnCredentialSave() {
    $.ajax({
        url: base + 'profile/UpdateCredential',
        type: 'POST',
        beforeSend: beforeAjaxStart('profile_container'),
        dataType: "json",
        traditional: true,
        data: $('#frm_access_credentials').serialize(),
        success: function(msg) {
            afterAjaxEnd('profile_container');
            var flag = parseFloat(msg.flag);
            var message = msg.message;
            
            if(flag === 1){
                $('#OldPassword').val('');
                $('#NewPassword').val('');
                $('#RetypePassword').val('');
            }
            showNotification(message);
        },
        error: function(msg) {
            afterAjaxEnd('profile_container');
            showNotification('A network error occur. Please try again');
        }
    });

    return false;
}

