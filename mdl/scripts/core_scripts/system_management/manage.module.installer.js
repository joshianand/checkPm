var get_module_url = base + 'installer/GetInstalledModules';
var update_module_url = base + 'installer/UpdateModule';
var install_module_url = base + 'installer/install_new_module';
var uninstall_module_url = base + 'installer/UninstallModule';

var installer_grid = '';

$(document).ready(function() {
    installer_grid = $("#installergrid").kendoGrid({
        columns: [
            {
                title: "Module name",
                field: "module_name"
            },
            {
                title: "Developer Name",
                field: "developer_name"
            },
            {
                title: "Developer email",
                field: "developer_email"
            },
            {
                title: "Developer contact",
                field: "developer_contact"
            },
            {
                title: "Developed date",
                field: "developed_date"
            },
            {
                title: "Installed date",
                field: "installed_date"
            },
            {
                title: "Version",
                field: "version"
            },
            {
                title: "Is active",
                field: "is_active"
            },
            {
                command: [
                    "edit",
                    {
                        text: "Uninstall",
                        click: uninstallModule
                    }],
                title: "Commands"
            }
        ],
        dataSource: {
            transport: {
                read: {
                    url: get_module_url,
                    dataType: "json"
                },
                update: {
                    url: update_module_url,
                    dataType: "json",
                    type: "POST",
                    data: {
                        csrf_portal: $('#csrf_portal').val()
                    },
                    complete: function(jqXHR, textStatus) {
                        var text = jqXHR.responseText;
                        var parts = text.split('*');
                        $("#installergrid").data("kendoGrid").dataSource.read();
                        if (parts[0] === 0) {
                            showNotification(parts[1]);
                        }
                    },
                    error: function(e) {
                    }
                }
            },
            schema: {
                data: "modules",
                total: "count",
                model: {
                    id: "module_id",
                    fields: {
                        module_id: {
                            editable: false,
                            nullable: true
                        },
                        task_id: {
                            editable: false,
                            nullable: true
                        },
                        module_name: {
                            editable: false,
                            nullable: true
                        },
                        developer_name: {
                            editable: false,
                            nullable: true
                        },
                        installed_date: {
                            editable: false,
                            nullable: true
                        },
                        developed_date: {
                            editable: false,
                            nullable: true
                        },
                        developer_email: {
                            editable: false,
                            nullable: true
                        },
                        developer_contact: {
                            editable: false,
                            nullable: true
                        },
                        version: {
                            editable: false,
                            nullable: true
                        },
                        is_active: {
                            type: "boolean"
                        }
                    }
                }
            },
            pageSize: 10,
            serverPaging: true,
            serverSorting: true
        },
        editable: "inline",
        height: 400,
        sortable: true,
        pageable: true,
        resizable: true
    }).data("kendoGrid");
});

function uninstallModule(e) {
    e.preventDefault();
    var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
    var task_id = dataItem.task_id;
    var module_id = dataItem.module_id;

    var csrf = $("input[name=csrf_portal]").val();
    var ans = confirm('Are you sure to uninstall this module?');

    if (ans) {
        $.ajax({
            url: uninstall_module_url,
            type: 'POST',
            data: {
                csrf_portal: csrf,
                task_id: task_id,
                module_id: module_id
            },
            dataType: "json",
            beforeSend: beforeAjaxStart('module_container'),
            success: function(msg) {
                afterAjaxEnd('module_container');

                var flag = parseFloat(msg.flag);
                var message = msg.message;

                if (flag === 1) {
                    installer_grid.dataSource.read();
                }
                showNotification(message);
            },
            error: function(msg) {
                afterAjaxEnd('module_container');
                showNotification('A network error occur. Please try again');
            }
        });
    }
}

function installNewModule() {
    window.location.href = install_module_url;
}