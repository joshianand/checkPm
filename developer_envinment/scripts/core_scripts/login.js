function onLogin() {
    var username = $('#username').val();
    var userpass = $('#password_field').val();

    if (username !== '' && userpass !== '') {
        $.ajax({
            url: base+'home/login',
            type: 'POST',
            dataType: 'JSON',
            beforesend: beforeAjaxStart('content'),
            data: $('#frm_login').serialize(),
            success: function (msg) {
                afterAjaxEnd('content');
                
                var flag = parseFloat(msg.flag);
                var message = msg.message;               
              
                if (flag === 1) {
                    window.location.href = base + "dashboard";
                }
                else if (flag === 0) {
                    message = '<span>'+message+'</span>'
                    $('.alert').html(message).show();
                }
            },
            error: function (msg) {
                message = '<span>A network error occurred. Please try letter</span>'
                $('.alert').html(message).show();
            }
        });
    }
}

function onResetPass(){
    var email = $('#email').val();
    
    if(email !== ''){
        $.ajax({
            url: base+'home/SendResetLink',
            type: 'POST',
            dataType: 'JSON',
            beforesend: beforeAjaxStart('content'),
            data: $('#frm_login').serialize(),
            success: function (msg) {
                afterAjaxEnd('content');
                
                var flag = parseFloat(msg.flag);
                var message = msg.message;               
              
                if (flag === 1) {
                    window.location.href = base + "dashboard";
                }
                else if (flag === 0) {
                    message = '<span>'+message+'</span>'
                    $('#resetAlert').html(message).show();
                }
            },
            error: function (msg) {
                message = '<span>A network error occurred. Please try letter</span>'
                $('#resetAlert').html(message).show();
            }
        });
    }
    
    return false;
}