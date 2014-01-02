var slogan_data_grid;
var get_slogan_data_url = base + 'slogan/GetSloganData';
var get_slogan_url = base + 'slogan/GetSlogans';
var create_slogan_url = base + 'slogan/CreateSloganData';
var update_slogan_url = base + 'slogan/UpdateSloganData';
var del_slogan_url = base + 'slogan/DeleteSloganData';

var csrf_val = $('#csrf_portal').val();

slogan_data_grid = $("#slogan_data_grid").kendoGrid({
    dataSource: {
        transport: {
            read: {
                url: get_slogan_data_url,
                dataType: "json"
            },
            create: {
                url: create_slogan_url,
                dataType: "json",
                type: "POST",
                data:{
                    csrf_portal: csrf_val
                },
                complete: function(jqXHR, textStatus) {
                    var text = jqXHR.responseText;
                    var parts = text.split('*');
                    $("#slogan_data_grid").data("kendoGrid").dataSource.read();
                    if (parts[0] == 0) {
                        alert(parts[1]);
                    }
                },
                error: function(e) {
                }
            },
            update: {
                url: update_slogan_url,
                dataType: "json",
                type: "POST",
                data:{
                    csrf_portal: csrf_val
                },
                complete: function(jqXHR, textStatus) {
                    var text = jqXHR.responseText;
                    var parts = text.split('*');
                    $("#slogan_data_grid").data("kendoGrid").dataSource.read();
                    if (parts[0] == 0) {
                        alert(parts[1]);
                    }
                },
                error: function(e) {
                }
            },
            destroy: {
                url: del_slogan_url,
                dataType: "json",
                type: "POST",
                data:{
                    csrf_portal: csrf_val
                },
                complete: function(jqXHR, textStatus) {
                    var text = jqXHR.responseText;
                    var parts = text.split('*');
                    $("#slogan_data_grid").data("kendoGrid").dataSource.read();
                    if (parts[0] == 0) {
                        alert(parts[1]);
                    }
                },
                error: function(e) {
                }
            }
        },
        schema: {
            data: "slogan_data",
            total: "count",
            model: {
                id: "data_id",
                fields: {
                    data_id: {
                        editable: false,
                        nullable: true
                    },
                    cities: {
                        validation: {
                            required: true
                        }
                    },
                    services: {
                        validation: {
                            required: true
                        }
                    },
                    modified_date: {
                        editable: false,
                        nullable: true
                    }}
            }
        },
        pageSize: 25,
        serverPaging: true,
        serverSorting: true
    },
    columns: [
        {
            title: "Cities",
            field: "cities",
            editor: CityEditor,
            template: "#= cities #"
        },
        {
            title: "Services",
            field: "services",
            editor: ServiceEditor,
            template: "#= services #"
        },
        {
            title: "Modified date",
            field: "modified_date",
            width: "150px"
        },
        {
            command: [
                "edit",
                "destroy"
            ],
            title: "Command",
            width: "210px"
        }
    ],
    detailTemplate: kendo.template($("#template").html()),
    detailInit: detailInit,
    editable: "popup",
    toolbar: ["create"],
    height: 600,
    resizable: true,
    sortable: true,
    pageable: true
}).data("kendoGrid");

function detailInit(e) {
    var detailRow = e.detailRow;

    detailRow.find(".slogans").kendoGrid({
        dataSource: {
            transport: {
                read: {
                    url: get_slogan_url,
                    dataType: "json",
                    data: {
                        data_id: e.data.data_id,
                        csrf_portal: csrf_val
                    }
                }
            },
            schema: {
                data: "slogans",
                total: "count"
            },
            pageSize: 25,
            serverPaging: true,
            serverSorting: true
        },
        columns: [
            {
                title: "Slogan",
                field: "slogan_name"
            }
        ],
        resizable: true,
        sortable: true,
        pageable: true
    }).data("kendoGrid");
}

function CityEditor(container, options) {
    $('<textarea data-value-field="cities" data-bind="value:' + options.field + '" row=70 col=70 style="width: 90%;height: 70px;" placeholder="Enter comma seperated cities" required></textarea>')
            .appendTo(container);
}

function ServiceEditor(container, options) {
    $('<textarea data-value-field="services" data-bind="value:' + options.field + '" row=70 col=70 style="width: 90%;height: 70px;" placeholder="Enter comma seperated services" required></textarea>')
            .appendTo(container);
}