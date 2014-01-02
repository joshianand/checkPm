var save_url =  base + 'users/SaveUser';
var update_url = base + 'users/UpdateUser';

var GroupSelection;

$(document).ready(function() { 
    Groupselection = $("#GroupSelection").kendoDropDownList().data("kendoDropDownList");
});

function onUserSave(tid) {
    $.ajax({
        url: save_url,
        type: 'POST',
        beforeSend: beforeAjaxStart('user_container'),
        dataType: "json",
        data: $('#frm_user').serialize(),
        success: function (msg) {
            afterAjaxEnd('user_container');          
            var flag = parseFloat(msg.flag);
            var message = msg.message;

            if (flag === 1 && tid !== '') {
                window.location.href = base + 'users/index?tid='+tid;
            }
            showNotification(message);
        },
        error: function (msg) {
            afterAjaxEnd('user_container');
            showNotification('A network error occur. Please try again');
        }
    });
    return false;
}

function onUserUpdate() {
    $.ajax({
        url: update_url,
        type: 'POST',
        beforeSend: beforeAjaxStart('user_container'),
        dataType: "json",
        data: $('#frm_user').serialize(),
        success: function (msg) {
            afterAjaxEnd('user_container');          
            var flag = parseFloat(msg.flag);
            var message = msg.message;
            showNotification(message);
        },
        error: function (msg) {
            afterAjaxEnd('user_container');
            showNotification('A network error occur. Please try again');
        }
    });
    return false;
}

function clearForm(){
    errors.splice(0, errors.length);
    notification='';
    $('#GroupSelection').val(0);
    $('#FirstName').val('');
    $('#LastName').val('');
    $('#Email').val('');
    $('#Country').val('');
    $('#Address').val('');
    $('#City').val('');
    $('#State').val('');
    $('#Zip').val('');
    $('#Phone').val('');
    $('#Mobile').val('');
    $('#LoginName').val('');
    $('#LoginPass').val('');
}