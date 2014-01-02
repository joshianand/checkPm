var save_selection_url = base + "domain/SaveSelectionSettings";
var search_slogan_url = base + "domain/SearchBySlogan";
var search_city_service_url = base + "domain/SearchByCityService";
var search_keyword_url = base + "domain/SearchByKeyword";
var get_domains_url = base + "domain/GetGeneratedDomains";
var save_domain_url = base + "domain/SaveSearchedDomains";
var get_slogan_url = base + "domain/GetSloganList";
var download_domains = base + "domain/DownloadGeneratedDomains";

var com_domain_grid, net_domain_grid, us_domain_grid;
var generated_id = '';

$(document).ready(function() {
    com_domain_grid = $("#com_domain_grid").kendoGrid({
        dataSource: {
            transport: {
                read: {
                    url: get_domains_url,
                    dataType: "json",
                    data: {
                        domain_type: 'com',
                        generated_id: ''
                    }
                }
            },
            schema: {
                data: "domains",
                total: "count"
            },
            pageSize: 10,
            serverPaging: false,
            serverSorting: false
        },
        columns: [
            {
                title: "ID",
                field: "domain_id",
                hidden: true
            },
            {
                title: "Domain name",
                field: "domain_name"
            }
        ],
        selectable: "multiple",
        navigatable: true,
        height: 300,
        resizable: true,
        sortable: true,
        pageable: true
    }).data("kendoGrid");

    net_domain_grid = $("#net_domain_grid").kendoGrid({
        dataSource: {
            transport: {
                read: {
                    url: get_domains_url,
                    dataType: "json",
                    data: {
                        domain_type: 'net',
                        generated_id: ''
                    }
                }
            },
            schema: {
                data: "domains",
                total: "count"
            },
            pageSize: 10,
            serverPaging: false,
            serverSorting: false
        },
        columns: [
            {
                title: "ID",
                field: "domain_id",
                hidden: true
            },
            {
                title: "Domain name",
                field: "domain_name"
            }
        ],
        selectable: "multiple",
        navigatable: true,
        height: 300,
        resizable: true,
        sortable: true,
        pageable: true
    }).data("kendoGrid");

    us_domain_grid = $("#us_domain_grid").kendoGrid({
        dataSource: {
            transport: {
                read: {
                    url: get_domains_url,
                    dataType: "json",
                    data: {
                        domain_type: 'us',
                        generated_id: ''
                    }
                }
            },
            schema: {
                data: "domains",
                total: "count"
            },
            pageSize: 10,
            serverPaging: false,
            serverSorting: false
        },
        columns: [
            {
                title: "ID",
                field: "domain_id",
                hidden: true
            },
            {
                title: "Domain name",
                field: "domain_name"
            }
        ],
        selectable: "multiple",
        navigatable: true,
        height: 300,
        resizable: true,
        sortable: true,
        pageable: true
    }).data("kendoGrid");
});

function saveSelection() {
    $.ajax({
        url: save_selection_url,
        type: 'POST',
        beforeSend: beforeAjaxStart('domain_container'),
        data: $('#frm_selection_options').serialize(),
        dataType: "json",
        success: function(msg) {
            afterAjaxEnd('domain_container');
            $('#options').modal('hide');
            showNotification("Selection updated");
        },
        error: function(msg) {
            afterAjaxEnd('domain_container');
            showNotification('A network error occur. Please try again');
        }
    });
}

function searchByKeyword() {
    if ($('#keywords').val() === '') {
        alert('Please provide at least 1 keyword');
    } else {
        $.ajax({
            url: search_keyword_url,
            type: 'POST',
            beforeSend: beforeAjaxStart('domain_container'),
            data: $('#frm_domain_search').serialize(),
            dataType: "json",
            success: function(msg) {
                afterAjaxEnd('domain_container');

                var flag = msg.flag;
                var message = msg.message;

                if (flag === 0) {
                    showNotification(message);
                } else {
                    $('#keywords').val('');
                    $('#domainsPerKeyword').val(1);
                    generated_id = msg.generated_id;
                    reloadDomains(generated_id);
                }
            },
            error: function(msg) {
                afterAjaxEnd('domain_container');
                showNotification('A network error occur. Please try again');
            }
        });
    }
}

function searchByCityService() {
    if ($('#cityNames').val() === '') {
        alert('Please provide at least 1 city name');
    } else if ($('#serviceNames').val() === '') {
        alert('Please provide at least 1 service name');
    } else {
        $.ajax({
            url: search_city_service_url,
            type: 'POST',
            beforeSend: beforeAjaxStart('domain_container'),
            data: $('#frm_city_service_search').serialize(),
            dataType: "json",
            success: function(msg) {
                afterAjaxEnd('domain_container');

                var flag = msg.flag;
                var message = msg.message;

                if (flag === 0) {
                    showNotification(message);
                } else {
                    $('#cityNames').val('');
                    $('#serviceNames').val('');
                    $('#domainsPerCombination').val(1);
                    generated_id = msg.generated_id;
                    reloadDomains(generated_id);
                }
            },
            error: function(msg) {
                afterAjaxEnd('domain_container');
                showNotification('A network error occur. Please try again');
            }
        });
    }
}

function searchBySlogan() {
    $.ajax({
        url: search_slogan_url,
        type: 'POST',
        beforeSend: beforeAjaxStart('domain_container'),
        data: {
            csrf_portal: $('#csrf_portal').val(),
            sloganSource: $('#sloganSource').val(),
            slogans: JSON.stringify($('#slogans').val()),
            domainsPerSlogan: $('#domainsPerSlogan').val()
        },
        dataType: "json",
        success: function(msg) {
            afterAjaxEnd('domain_container');

            var flag = msg.flag;
            var message = msg.message;

            if (flag === 0) {
                showNotification(message);
            } else {
                generated_id = msg.generated_id;
                reloadDomains(generated_id);
            }
        },
        error: function(msg) {
            afterAjaxEnd('domain_container');
            showNotification('A network error occur. Please try again');
        }
    });
}

function onSloganKeyChange() {
    var source = $('#sloganSource').val();
    //var text = $('#slogan_key option:selected').text();

    if (source === '') {
        $('#slogans').empty();
    } else {
        $.ajax({
            url: get_slogan_url,
            type: 'POST',
            beforeSend: beforeAjaxStart('domain_container'),
            data: $('#frm_slogan_search').serialize(),
            dataType: "json",
            success: function(msg) {
                afterAjaxEnd('domain_container');
                var options = msg.options;
                var optionString = '';

                for (var i = 0; i < options.length; i++) {
                    optionString += '<option value="' + options[i].slogan_id + '">' + options[i].slogan_name + '</option>';
                }
                if (optionString !== '') {
                    $('#slogans').empty().append(optionString);
                }
            },
            error: function(msg) {
                afterAjaxEnd('domain_container');
                showNotification('A network error occur. Please try again');
            }
        });
    }

    return false;
}

function saveSearchedDomain() {
    var com_selections = [];
    var net_selections = [];
    var us_selections = [];

    var com_rows = com_domain_grid.select();
    com_rows.each(function(index, row) {
        var selectedItem = com_domain_grid.dataItem(row);
        com_selections.push(selectedItem.domain_id);
    });

    var net_rows = net_domain_grid.select();
    net_rows.each(function(index, row) {
        var selectedItem = net_domain_grid.dataItem(row);
        net_selections.push(selectedItem.domain_id);
    });

    var us_rows = us_domain_grid.select();
    us_rows.each(function(index, row) {
        var selectedItem = us_domain_grid.dataItem(row);
        us_selections.push(selectedItem.domain_id);
    });

    if (com_selections.length === 0 && net_selections === 0 && us_selections === 0) {
        alert('Please select at least 1 domain to save');
    } else {
        $.ajax({
            url: save_domain_url,
            type: 'POST',
            beforeSend: beforeAjaxStart('domain_container'),
            data: {
                csrf_portal: $('#csrf_portal').val(),
                com_selections: JSON.stringify(com_selections),
                net_selections: JSON.stringify(net_selections),
                us_selections: JSON.stringify(us_selections)
            },
            dataType: "json",
            success: function(msg) {
                afterAjaxEnd('domain_container');

                var flag = msg.flag;
                var message = msg.message;

                if (flag === 1) {
                    reloadDomains('');
                }

                showNotification(message);
            },
            error: function(msg) {
                afterAjaxEnd('domain_container');
                showNotification('A network error occur. Please try again');
            }
        });
    }
}

function reloadDomains(generated_id) {
    this.generated_id = generated_id;
    com_domain_grid.dataSource.read({domain_type: 'com', 'generated_id': generated_id});
    net_domain_grid.dataSource.read({domain_type: 'net', 'generated_id': generated_id});
    us_domain_grid.dataSource.read({domain_type: 'us', 'generated_id': generated_id});
}

function downloadGeneratedDomains() {
    if (generated_id === '') {
        showNotification('No generated domains found. Please search again');
    } else {
        window.location.href = download_domains + "?gid=" + generated_id;
    }
}

