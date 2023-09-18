$(document).ready(function () {
    recalculate_itemTotlaRow();
    $(document).on('click', '#im1', function (e) {
        var herf = $(this).attr("href");
        $('.photo').attr('src', herf)
    });

    $(document).on('input', '#item_quantity', function (e) {
        recalculate_itemTotlaRow();
    });


    function recalculate_itemTotlaRow() {
        var item_quantity = $("#item_quantity").val();
        if (item_quantity == "") item_quantity = 0;
        var item_price = $("#item_price").val();
        if (item_price == "") item_price = 0;
        $("#item_total").val((parseFloat(item_quantity) * parseFloat(item_price)) * 1);
    }
   

    function load_order_daital_modal(auto_serial) {
        var token = $("#token_search").val();
        var url = $("#ajax_load_order_details_modal").val();
        jQuery.ajax({
            url: url,
            type: 'post',
            dataType: 'html',
            cache: false,
            data: {
                "_token": token,
                auto_serial: auto_serial
            },
            success: function (data) {
                $("#InvoiceModalActiveDetailsBody").html(data);
                $("#InvoiceModalActiveDetails").modal("show");
            },
            error: function () {
                alert(auto_serial + "حدث خطاما");
            }
        });
    }
    $(document).on('click', '.load_order_details_modal', function (e) {
        var auto_serial = $(this).data("autoserial");

        load_order_daital_modal(auto_serial);
    });

    $(document).on('click', '.load_invoice_details_modal', function (e) {
        var itemcard_id = $(this).data("itemcard_id");
        load_invoice_Add_modal(itemcard_id);
    });

    $(document).on('click', '#Do_Add_new_active_roder', function (e) {
        item_quantity = $("#item_quantity").val();
        if (item_quantity == "") {
            alert("من فضلك  حدد  الكمية ");
            $("#item_quantity").focus();
            return false;
        } else {
            recalculate_itemTotlaRow();

        }
        var item_total = $("#item_total").val();
        var id = $(this).data("itemcard_id");
        var token = $("#token_search").val();
        var url = $("#addActiveorder").val();
        jQuery.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            cache: false,
            data: {
                id: id,
                item_total: item_total,
                item_quantity: item_quantity,
                "_token": token

            },
            success: function (data) {
                if (data == 'allowed') {
                    $("#barcodeCheckMessage").text("(تم الاضافة بنجاح)");
                    $("#barcodeCheckMessage").css('color', 'green');
                } else {
                    $("#barcodeCheckMessage").text("( عفوا المنتج  تم اضافة من قبل  يمكن  ان تعدل علية ) ");
                    $("#barcodeCheckMessage").css('color', 'red');
                }
            },
            error: function () {
                alert(id + "عفواً حدث خطاء");
            }


        });
    });





    $(document).on('click', '#EditDetailsItem', function (e) {
        item_quantity = $("#item_quantity").val();
        if (item_quantity == "") {
            alert("من فضلك  حدد  الكمية ");
            $("#item_quantity").focus();
            return false;
        } else {
            recalculate_itemTotlaRow();

        }
        var item_total = $("#item_total").val();
        var id = $(this).data("id");
        var token = $("#token_search").val();
        var url = $("#ajax_get_load_order_update").val();
        jQuery.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            cache: false,
            data: {
                id: id,
                item_total: item_total,
                item_quantity: item_quantity,
                "_token": token

            },
            success: function (data) {
                if (data == 'allowed') {
                    $("#updateInvoiceModalActiveInvoiceBody").html("");
                    $("#updateInvoiceModalActiveInvoice").modal("hide");
                    $("#InvoiceModalActiveDetailsBody").html(data);
                    $("#InvoiceModalActiveDetails").modal("show");

                    $("#barcodeCheckMessage").text("(تم التحديث بنجاح)");
                    $("#barcodeCheckMessage").css('color', 'green');
                } else {
                    $("#barcodeCheckMessage").text("( عفوا   حدث خطاء ) ");
                    $("#barcodeCheckMessage").css('color', 'red');
                }
            },
            error: function () {
                alert("عفواً حدث خطاء");
            }


        });
    });
    $(document).on('click', '.remove_active_row_item', function (e) {
        var url = $("#ajax_get_remove_active_row_item").val();
        var token = $("#token_search").val();
        var id = $(this).data("id");
        jQuery.ajax({
            url: url,
            type: 'post',
            dataType: 'html',
            cache: false,
            data: {
                "_token": token,
                id: id
            },
            success: function (data) {
                load_order_daital_modal(data);
            },
            error: function () {
                alert("حدث خطاما");
            }
        });
    });

    $(document).on('click', '#load_close_approve_order', function (e) {
        var url = $("#ajax_get_send_order").val();
        var id = $(this).data("id");
        var token = $("#token_search").val();
        var id = $(this).data("id");

        jQuery.ajax({
            url: url,
            type: 'post',
            dataType: 'html',
            cache: false,
            data: {
                "_token": token,
                id: id
            },
            success: function (data) {
                load_order_daital_modal(data);
            },
            error: function () {
                alert("حدث خطاما");
            }
        });
    });

});