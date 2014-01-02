$(document).ready(function () {
    var id = 0;
    $(".inv_line_add").click(function (e) {
        e.preventDefault();
        id++;
        var table = $(this).closest("table");
        var clonedRow = table.find(".inv_row").clone();
        clonedRow.removeAttr("class")
        clonedRow.find(".id").attr("value", id);
        clonedRow.find(".inv_clone_row").html('<a href="#" class="btn btn-danger inv_remove_btn"><i class="icon-minus icon-white"></i></a>');
        clonedRow.find("input").each(function () {
            $(this).val('');
        });
        table.find(".last_row").before(clonedRow);
    });
    $(".inv_table").on("click", ".inv_remove_btn", function (e) {
        e.preventDefault();
        $(this).closest("tr").remove();
        
    });
});