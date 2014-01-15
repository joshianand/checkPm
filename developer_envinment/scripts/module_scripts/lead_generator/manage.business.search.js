var get_search_list_url = base + 'businesssearch/GetSearchList';
var scrape_email_url = base + 'leadgenerator/ScrapeEmails';
var analyze_site_url = base + 'leadgenerator/AnalyzeSite';
var del_search_url = base + 'leadgenerator/DeleteYellowSearch';
var del_search_combination_url = base + 'leadgenerator/DeleteSearchCombination';
var download_url = base + 'leadgenerator/DownloadSearchResults?search_id=';

var yellow_data_grid;
var search_combination_grid;

$(document).ready(function() {
    $("#citySelection").select2({ 
        maximumSelectionSize: 1, 
        width: '220px' ,
        allowClear: true
    });
    
    $("#searchText").select2({ 
        maximumSelectionSize: 1, 
        tags:[], 
        width: '220px',
        tokenSeparators: [","],
        allowClear: true
    });
    
    initializeSearchList("", "");
});

function newSearch() {
    var selectedCities = $("#citySelection option:selected").length;
    
    if((selectedCities == 0 && typeof $("#selectAllCities:checked").val() == "undefined") && $('#searchText').val() == '') {
        alert('Select any search parameters');
    } else {
        $('#options').modal('hide');
        var selectedCity = $("#citySelection option:selected").val();  
        var selectedText = $('#searchText').val();
        
        initializeSearchList(selectedCity, selectedText);
        
        $('#searchText').select2("val", "");
        $('#citySelection').select2("val", "");
    }
}

function scrapeEmail(e) {
    e.preventDefault();
    var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
    
    $.ajax({
        url: scrape_email_url,
        type: 'POST',
        data: {
            search_id: dataItem.search_id,
            csrf_portal: $('#csrf_portal').val()
        },
        beforeSend: beforeAjaxStart('search_container'),
        dataType: "json",
        success: function(msg) {
            afterAjaxEnd('search_container');

            var flag = msg.flag;
            var message = msg.message;

            if (flag === 1) {
                yellow_data_grid.dataSource.read();
            }

            showNotification(message);
        },
        error: function(msg) {
            afterAjaxEnd('search_container');
            showNotification('A network error occur. Please try again');
        }
    });

}

function analyzeWebsite(e){
    e.preventDefault();
    var dataItem = this.dataItem($(e.currentTarget).closest("tr"));

    $.ajax({
        url: analyze_site_url,
        type: 'POST',
        data: {
            search_id: dataItem.search_id,
            csrf_portal: $('#csrf_portal').val()
        },
        beforeSend: beforeAjaxStart('search_container'),
        dataType: "json",
        success: function(msg) {
            afterAjaxEnd('search_container');

            var flag = msg.flag;
            var message = msg.message;

            if (flag === 1) {
                yellow_data_grid.dataSource.read();
            }

            showNotification(message);
        },
        error: function(msg) {
            afterAjaxEnd('search_container');
            showNotification('A network error occur. Please try again');
        }
    });
}

function downloadResults(e) {
    e.preventDefault();
    var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
    if (dataItem.search_status === 'pending') {
        showNotification('Nothing found to be download. This query is still pending');
    } else {
        var template = kendo.template($("#downloadTemplate").html());
        $("#downloadOptions").html(template({
            search_id: dataItem.search_id
        }));
        $('#downloadOptions').modal('show');
    }
}

function downloadBusiness() {
    var queryString = download_url + $('#search_id').val() + "&format=" + $('#downloadFormat').val() + '&';
    
    if ($('#bsNameCheck').is(':checked')) {
        queryString += "name=on&";
    } else {
        queryString += "name=off&";
    }
    
    if ($('#bsCatCheck').is(':checked')) {
        queryString += "cat=on&";
    } else {
        queryString += "cat=off&";
    }
    
    if ($('#bsAddCheck').is(':checked')) {
        queryString += "add=on&";
    } else {
        queryString += "add=off&";
    }
    
    if ($('#bsCityCheck').is(':checked')) {
        queryString += "city=on&";
    } else {
        queryString += "city=off&";
    }
    
    if ($('#bsStateCheck').is(':checked')) {
        queryString += "state=on&";
    } else {
        queryString += "state=off&";
    }
    
    if ($('#bsZipCheck').is(':checked')) {
        queryString += "zip=on&";
    } else {
        queryString += "zip=off&";
    }
    
    if ($('#bsPhnCheck').is(':checked')) {
        queryString += "phn=on&";
    } else {
        queryString += "phn=off&";
    }
    
    if ($('#bsWebCheck').is(':checked')) {
        queryString += "web=on&";
    } else {
        queryString += "web=off&";
    }
    
    if ($('#bsMailCheck').is(':checked')) {
        queryString += "mail=on&";
    } else {
        queryString += "mail=off&";
    }
    
    if ($('#bsRateCheck').is(':checked')) {
        queryString += "rate=on&";
    } else {
        queryString += "rate=off&";
    }
    
    if ($('#bsDmnOwnerCheck').is(':checked')) {
        queryString += "domainOwner=on&";
    } else {
        queryString += "domainOwner=off&";
    }
    
    if ($('#bsDmnAgeCheck').is(':checked')) {
        queryString += "domainAge=on&";
    } else {
        queryString += "domainAge=off&";
    }
    
    if ($('#bsSeoScoreCheck').is(':checked')) {
        queryString += "seoScore=on&";
    } else {
        queryString += "seoScore=off&";
    }
    
    if ($('#bsSeoTipsCheck').is(':checked')) {
        queryString += "seoTips=on&";
    } else {
        queryString += "seoTips=off&";
    }
    
    if ($('#webOption').is(':checked')) {
        queryString += "webOption=on&";
    } else {
        queryString += "webOption=off&";
    }
    
    if ($('#emailOption').is(':checked')) {
        queryString += "emailOption=on";
    } else {
        queryString += "emailOption=off";
    }
    
    $('#downloadOptions').modal('hide');
    window.location.href = queryString;
}

function initializeSearchList(_city, _searchText){
    yellow_data_grid = $("#searchGrid").kendoGrid({
        dataSource: {
            transport: {
                read: {
                    url: get_search_list_url,
                    dataType: "json",
                    data:{
                        city: _city,
                        search_text: _searchText
                    }
                },
                destroy: {
                    url: del_search_url,
                    dataType: "json",
                    type: "POST",
                    data: {
                        csrf_portal: $('#csrf_portal').val()
                    },
                    complete: function(jqXHR, textStatus) {
                        var text = jqXHR.responseText;
                        var parts = text.split('*');
                        $("#searchGrid").data("kendoGrid").dataSource.read();
                    },
                    error: function(e) {
                    }
                }
            },
            schema: {
                data: "search_data",
                total: "count",
                model: {
                    id: "search_id",
                    fields: {
                        search_id: {
                            editable: false,
                            nullable: true
                        }
                    }
                }
            },
            pageSize: 25,
            serverPaging: true,
            serverSorting: true
        },
        columns: [
            {
                title: "Search city",
                field: "city_name"
            },
            {
                title: "Search text",
                field: "search_text"
            },
            {
                title: "Total business",
                field: "total_business_found"
            },
            {
                title: "Search status",
                field: "search_status"
            },
            {
                title: "Email scraped",
                field: "email_scraped"
            },
            {
                title: "Site analyzed",
                field: "site_analyzed"
            },
            {
                title: "Modified date",
                field: "modified_date",
                width: "150px",
                filterable: false
            },
            {
                command: [
                    {
                        text: "Download results",
                        click: downloadResults
                    },
                    "destroy"
                ],
                title: "Command",
                width: "230px"
            }
        ],
        editable: "inline",
        filterable: {
            extra: false,
            operators: {
                string: {
                    startswith: "Starts with",
                    eq: "Is equal to",
                    neq: "Is not equal to"
                }
            }
        },
        columnMenu: true,
        height: 600,
        resizable: true,
        sortable: true,
        pageable: true
    }).data("kendoGrid");
}