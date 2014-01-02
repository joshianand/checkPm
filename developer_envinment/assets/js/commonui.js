var errors = new Array;
var notification = '';

function beforeAjaxStart(containerClass) {
    $('.' + containerClass).block({
        message: '<img src="' + base + '/assets/img/loading.gif" align="absmiddle"><p>Please wait</p>',
        css: {
            padding: '2px',
            backgroundColor: 'none'
        },
        overlayCSS: {
            backgroundColor: '#fff',
            opacity: 0.05,
            cursor: 'wait'
        }
    });
}

function afterAjaxEnd(containerClass) {
    $('.' + containerClass).unblock({
        onUnblock: function() {
            $(containerClass).removeAttr("style");
        }
    });
}

function showNotification(message) {
    $.gritter.removeAll();
    $.gritter.add({
        title: 'Result',
        text: message,
        class_name: 'gritter-light'
    });
}