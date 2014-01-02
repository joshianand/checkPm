$(document).ready(function () {
    $("#item-add").on("click", function () {

        var sTable = $("#invoice-items");
        var RowAppend = ['<tr class="item-row">', '<td><button class="btn btn-danger" id="RemoveITEM"' +
            ' type="button"><i class="icon-trash icon-white"></i> Remove</button></td>',
             '<td><input type="text" name="description[]"' +
                ' class="input-xxlarge typeahead" value="" /></td>', '<td>' +
                '<input name="amount[]" class=" input-small" id="Price"' +
                ' type="text"></td>', "</tr>"].join("");
        var sLookup = $(RowAppend);

        var description = sLookup.find("#description");
        

            $(".item-row:last", sTable).after(sLookup);
            $(description).focus();

            sLookup.find("#RemoveITEM").on("click", function () {

                $(this).parents(".item-row").remove();
                
                if ($(".item-row").length < 2) $("#deleteRow").hide();
                var e = $(this).closest("tr");
        total_amount(e)
            });
            sLookup.find("#Price").on("keyup", function () {
                var e = $(this).closest("tr");
                total_amount(e)
            })

        return false
    })
});
var total_amount = function (e) {
    var t = e.find("#Price").val();

    isNaN(t) ? e.find("#Price").val("N/A") : e.find("#Price").val(t);
    update_total()
};
var update_total = function () {
    var e = 0;
    $("input#Price").each(function (t) {
        price = $(this).val();
        if (!isNaN(price)) e += Number(price)
    });
    $("#totalTxt").html('<h5 class="pull-right">Total Amount:</h5>');
    $("#total-amount").html("<h5>" + e + "</h5>")
};
