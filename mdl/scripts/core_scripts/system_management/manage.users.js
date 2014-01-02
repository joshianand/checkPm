var get_user_url = base + 'users/GetUsers';
var add_user_url = base + 'users/add_new_user';
var edit_user_url = base + 'users/edit_user?item=';
var reset_crednetial_url = base + 'users/ResetCredentials';
var del_user_url = base + 'users/DeleteUser';

var user_grid = '';

$(document).ready(function() {
    user_grid = $("#usergrid").kendoGrid({
        columns: [
            {
                title: "Group name",
                field: "group_name"
            },
            {
                title: "First name",
                field: "first_name"
            },
            {
                title: "Last name",
                field: "last_name"
            },
            {
                title: "Email",
                field: "email"
            },
            {
                title: "Contact",
                field: "phone"
            },
            {
                title: "Active status",
                field: "active",
            },
            {
                command: [
                    {
                        text: "Edit",
                        click: editUser
                    },
                    {
                        text: "Delete",
                        click: deleteUser
                    }, {
                        name: "reset",
                        text: "Reset password",
                        click: resetCredential
                    }],
                title: "Commands",
                width: "280px"
            }
        ],
        dataSource: {
            transport: {
                read: {
                    url: get_user_url,
                    dataType: "json"
                }
            },
            schema: {
                data: "users",
                total: "count"
            },
            pageSize: 10,
            serverPaging: true,
            serverSorting: true
        },
        height: 400,
        sortable: true,
        pageable: true
    }).data("kendoGrid");
});

function createNewUser() {
    window.location.href = add_user_url ;
}

function editUser(e){
    e.preventDefault();
    var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
    var id = dataItem.user_id;
    window.location.href = edit_user_url + id;
}

function deleteUser(e) {
    e.preventDefault();
    var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
    var id = dataItem.user_id;

    var csrf = $("input[name=csrf_portal]").val();
    var ans = confirm('Are you sure to delete this user?');

    if (ans) {
        $.ajax({
            url: del_user_url,
            type: 'POST',
            data: {
                csrf_portal: csrf,
                user_id: id
            },
            dataType: "json",
            beforeSend: beforeAjaxStart('user_container'),
            success: function(msg) {
                afterAjaxEnd('user_container');

                var flag = parseFloat(msg.flag);
                var message = msg.message;

                if (flag === 1) {
                    user_grid.dataSource.read();
                }
                showNotification(message);
            },
            error: function(msg) {
                afterAjaxEnd('user_container');
                showNotification('A network error occur. Please try again');
            }
        });
    }
}

function resetCredential(e){
    e.preventDefault();
    var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
    var id = dataItem.user_id;
    
    var csrf=$("input[name=csrf_portal]").val();
    var ans=confirm('Are you sure to reset password of this user?');
    
    if(ans){
        $.ajax({
            url: reset_crednetial_url,   
            type: 'POST',    
            data: {
                csrf_portal: csrf,
                user_id: id
            },
            dataType: "json",
            beforesend: beforeAjaxStart('user_container'),  
            success: function (msg) {
                afterAjaxEnd('user_container');

                var flag = parseFloat(msg.flag);
                var message = msg.message;

                showNotification(message);
            },
            error: function (msg) {
                afterAjaxEnd('group_container');
                showNotification('A network error occur. Please try again');
            } 
        });
    }
}
