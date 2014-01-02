var checked_list = new Array();
var save_url =  base + 'usergroups/SaveUserGroup';
var update_url = base + 'usergroups/UpdateUserGroup';

function onGroupSave(tid){
    checkTasks();
    
    $.ajax({
        url: save_url,
        type: 'POST',
        beforeSend: beforeAjaxStart('user_group_container'),
        dataType: "json",
        data: $('#frm_user_group').serialize()+"&task="+JSON.stringify(checked_list),
        success: function (msg) {
            afterAjaxEnd('user_group_container');          
            var flag = parseFloat(msg.flag);
            var message = msg.message;
            
            if (flag === 1 && tid !== '') {
                window.location.href=base + 'usergroups/index?tid='+tid;
            } else {
                clearForm();
                showNotification(message);
            }
        },
        error: function (msg) {
            afterAjaxEnd('user_group_container');
            showNotification('A network error occur. Please try again');
        }
    });
    return false;
}

function onGroupUpdate(){
    checkTasks();
    
    $.ajax({
        url: update_url,
        type: 'POST',
        beforeSend: beforeAjaxStart('user_group_container'),
        dataType: "json",
        data: $('#frm_user_group').serialize()+"&task="+JSON.stringify(checked_list),
        success: function (msg) {
            afterAjaxEnd('user_group_container');          
            var flag = parseFloat(msg.flag);
            var message = msg.message;
            
            showNotification(message);
        },
        error: function (msg) {
            afterAjaxEnd('user_group_container');
            showNotification('A network error occur. Please try again');
        }
    });
    return false;
}

function clearForm(){
    checked_list.splice(0, checked_list.length);
    $('#GroupName').val('');
    $('input[name=taskcheck]').each(function () {
        if ($(this).attr('checked')) {
            $(this).removeAttr('checked'); 
        }
    });
}

function checkTasks() {
    $('input[name=taskcheck]').each(function () {
        var val = $(this).val();
        if ($(this).attr('checked')) {
            checked_list.push(val);
        }
    });

    checked_list = $.unique(checked_list);
}