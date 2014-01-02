var save_url = base + 'installer/SaveModule';
var upload_url = base + 'installer/UploadFile';

$(document).ready(function() {
    $("#installerFile").kendoUpload({
        async: {
            saveUrl: upload_url,
            autoUpload: true,
            multiple: false
        },
        upload: onInstallerUpload,
        success: onInstallerUploaded
    }).data("kendoUpload");
});

function onInstall(tid) {
    $.ajax({
        url: save_url,
        type: 'POST',
        beforeSend: beforeAjaxStart('module_installer_container'),
        dataType: "json",
        data: $('#frm_module_installer').serialize(),
        success: function(msg) {
            afterAjaxEnd('module_installer_container');
            var flag = parseFloat(msg.flag);
            var message = msg.message;

            if (flag === 1) {
                window.location.href = base + 'installer/index?tid=' + tid;
            } else {
                showNotification(message);
            }
        },
        error: function(msg) {
            afterAjaxEnd('user_container');
            showNotification('A network error occur. Please try again');
        }
    });
    return false;
}

function onInstallerUpload(e) {
    var files = e.files;
    e.data = { 'csrf_portal': $('#csrf_portal').val() };
    
    $.each(files, function() {
        if (this.extension !== ".zip") {
            showNotification('Only zip files can be uploaded');
            e.preventDefault();
        }
    });
}

function onInstallerUploaded(e) {
    var object = e.response;
    if (object.status === 'failed') {
       showNotification(object.message);
    } else if (object.status === 'ok') {
        $('#uploadedFileName').val(object.fileName);
    } else {
        showNotification('Upload failed. Please try later');
    }
}