var get_module_url = base + 'modules/GetModules';
var create_module_url = base + 'modules/CreateModules';
var update_module_url = base + 'modules/UpdateModule';
var del_module_url = base + 'modules/DeleteModule';

var module_grid = '';

$(document).ready(function() {
    module_grid = $("#modulegrid").kendoGrid({
        columns: [
            {
                title: "Name",
                field: "task_name"
            },
            {
                title: "Order",
                field: "sorting_order",
                format: "{0:0}"
            },
            {
                title: "Active status",
                field: "active",
                width: "90px"
            },
            {
                command: ["edit", "destroy"],
                title: "Command",
                width: "210px"
            }
        ],
        dataSource: {
            transport: {
                read: {
                    url: get_module_url,
                    dataType: "json"
                },
                create: {
                    url: create_module_url,
                    dataType: "json",
                    type: "POST",
                    data: {
                        csrf_portal: $("input[name=csrf_portal]").val()
                    },
                    complete: function(jqXHR, textStatus) {
                        var text = jqXHR.responseText;
                        var parts = text.split('*');
                        showNotification(parts[1]);
                        $("#modulegrid").data("kendoGrid").dataSource.read();
                    },
                    error: function(e) {
                    }
                },
                update: {
                    url: update_module_url,
                    dataType: "json",
                    type: "POST",
                    data: {
                        csrf_portal: $("input[name=csrf_portal]").val()
                    },
                    complete: function(jqXHR, textStatus) {
                        var text = jqXHR.responseText;
                        var parts = text.split('*');
                        showNotification(parts[1]);
                        $("#modulegrid").data("kendoGrid").dataSource.read();
                    },
                    error: function(e) {
                    }
                },
                destroy: {
                    url: del_module_url,
                    dataType: "json",
                    type: "POST",
                    data: {
                        csrf_portal: $("input[name=csrf_portal]").val()
                    },
                    complete: function(jqXHR, textStatus) {
                        var text = jqXHR.responseText;
                        var parts = text.split('*');
                        showNotification(parts[1]);
                        $("#modulegrid").data("kendoGrid").dataSource.read();
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
                        task_name: {
                            validation: {
                                required: true
                            }
                        },
                        sorting_order: {
                            type: "number", validation: {required: true, min: 1}
                        },
                        active: {
                            type: "boolean"
                        }
                    }
                }
            },
            pageSize: 10,
            serverPaging: true,
            serverSorting: true
        },
        toolbar: ["create"],
        editable: "inline",
        detailTemplate: kendo.template($("#template").html()),
        detailInit: detailInit,
        height: 400,
        sortable: true,
        pageable: true,
        resizable: true
    }).data("kendoGrid");
});

function detailInit(e) {
    var detailRow = e.detailRow;
    var module_id = e.data.module_id;

    detailRow.find(".tabstrip").kendoTabStrip({
        animation: {
            open: {effects: "fadeIn"}
        }
    });

    detailRow.find("#submodules").kendoGrid({
        columns: [
            {
                title: "Name",
                field: "task_name"
            },
            {
                title: "Controller",
                field: "controller_name"
            },
            {
                title: "Function",
                field: "function_name"
            },
            {
                title: "Order",
                field: "sorting_order",
                format: "{0:0}"
            },
            {
                title: "Active status",
                field: "active",
                width: "90px"
            },
            {
                command: ["edit", "destroy"],
                title: "Command",
                width: "210px"
            }
        ],
        dataSource: {
            transport: {
                read: {
                    url: get_module_url,
                    dataType: "json",
                    type: "GET",
                    data: {
                        parent_id: module_id
                    }
                },
                create: {
                    url: create_module_url,
                    dataType: "json",
                    type: "POST",
                    data: {
                        csrf_portal: $("input[name=csrf_portal]").val(),
                        parent_id: module_id
                    },
                    complete: function(jqXHR, textStatus) {
                        var text = jqXHR.responseText;
                        var parts = text.split('*');
                        showNotification(parts[1]);
                        $("#submodules").data("kendoGrid").dataSource.read();
                    },
                    error: function(e) {
                    }
                },
                update: {
                    url: update_module_url,
                    dataType: "json",
                    type: "POST",
                    data: {
                        csrf_portal: $("input[name=csrf_portal]").val(),
                        parent_id: module_id
                    },
                    complete: function(jqXHR, textStatus) {
                        var text = jqXHR.responseText;
                        var parts = text.split('*');
                        showNotification(parts[1]);
                        $("#submodules").data("kendoGrid").dataSource.read();
                    },
                    error: function(e) {
                    }
                },
                destroy: {
                    url: del_module_url,
                    dataType: "json",
                    type: "POST",
                    data: {
                        csrf_portal: $("input[name=csrf_portal]").val()
                    },
                    complete: function(jqXHR, textStatus) {
                        var text = jqXHR.responseText;
                        var parts = text.split('*');
                        showNotification(parts[1]);
                        $("#submodules").data("kendoGrid").dataSource.read();
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
                        task_name: {
                            validation: {
                                required: true
                            }
                        },
                        controller_name: {
                            validation: {
                                required: true
                            }
                        },
                        function_name: {
                            validation: {
                                required: true
                            }
                        },
                        sorting_order: {
                            type: "number", validation: {required: true, min: 1}
                        },
                        active: {
                            type: "boolean"
                        }
                    }
                }
            },
            pageSize: 10,
            serverPaging: true,
            serverSorting: true
        },
        toolbar: ["create"],
        editable: "inline",
        height: 400,
        sortable: true,
        pageable: true,
        resizable: true
    });
}