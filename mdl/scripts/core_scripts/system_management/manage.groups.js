var get_group_url = base+'usergroups/GetUserGroups';
var edit_group_url = base + 'usergroups/edit_group?item=';
var del_group_url = base + 'usergroups/DeleteUserGroup';
var group_grid = '';

$(document).ready(function(){   
    group_grid = $("#groupgrid").kendoGrid({
        columns: [{
            title: "Group name", 
            field: "group_name"
        },
        {
            title: "Active status", 
            field: "active",
            width: "90px"
        },
        {
            command:[
            {
                text: "Edit", 
                click: editUserGroup
            },

            {
                text: "Delete", 
                click: deleteUserGroup
            }],
            title: "Commands",
            width: "190px"
        }
        ],

        dataSource: {
            transport: {
                read: {
                    url: get_group_url,
                    dataType: "json"
                }
            },
            schema:{
                data: "groups",
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

function editUserGroup(e){
    e.preventDefault();
    var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
    var id = dataItem.group_id;
    document.location.href = edit_group_url + id;
}

function deleteUserGroup(e){
    e.preventDefault();
    var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
    var id = dataItem.group_id;
    
    var csrf=$("input[name=csrf_portal]").val();
    var ans=confirm('By deleting this group all group users will be deleted. Are you sure to delete this group?');
    
    if(ans){
        $.ajax({
            url: del_group_url,   
            type: 'POST',    
            data: {
                csrf_portal: csrf,
                group_id: id
            },
            dataType: "json",
            beforeSend: beforeAjaxStart('group_container'),
            success: function (msg) {
                afterAjaxEnd('group_container');
                
                var flag = parseFloat(msg.flag);
                var message = msg.message;

                if(flag === 1){
                    group_grid.dataSource.read();
                }
                showNotification(message);
            },
            error: function (msg) {
                afterAjaxEnd('group_container');
                showNotification('A network error occur. Please try again');
            } 
        });
    }
}

function addNew(){
    document.location.href=base+'usergroups/addnewgroup';
}

function createNewGroup(){
    window.location.href = base + 'usergroups/add_new_group';
}