$(document).ready(function () {
    $(document).on('click', '#update_image', function (e) {
        e.preventDefault();
        if (!$('#photo').length) {
            $('#oldimage').html('<br><input type="file" id="photo" name="photo" >');
            $('#oldimage1').html('<br><input type="file" id="photo1" name="photo1" >');
            $('#oldimage2').html('<br><input type="file" id="photo2" name="photo2" >');
            $('#oldimage3').html('<br><input type="file" id="photo3" name="photo3" >');
            $('#oldimage4').html('<br><input type="file" id="photo4" name="photo4" >');
            $('#update_image').hide();
            $('#cancel_update_image').show();

        }

    });
    $(document).on('click', '#cancel_update_image', function (e) {
        e.preventDefault();
        if ($('#photo').length) {
            $('#oldimage').html('');
            $('#oldimage1').html('');
            $('#oldimage2').html('');
            $('#oldimage3').html('');
            $('#oldimage4').html('');
            $('#update_image').show();
            $('#cancel_update_image').hide();

        }
        return false;
    });
    $(document).on('click', '.are_you_shue', function (e) {
        var res = confirm("هل انت متاكد تريد الحذف ؟");

        if (!res) {
            return false;
        }

    });
    $(document).on('click', '.are_you_sure', function (e) {
        var res = confirm("هل انت متاكد تريد الحذف من القائمة المفضلة ؟");

        if (!res) {
            return false;
        }

    });

    var url = window.location;
    // for sidebar menu but not for treeview submenu
    $('ul.sidebar-menu a').filter(function () {
        return this.href == url;
    }).parent().siblings().removeClass('active').end().addClass('active');
    // for treeview which is like a submenu
    $('ul.treeview-menu a').filter(function () {
        return this.href == url;
    }).parentsUntil(".sidebar-menu > .treeview-menu").siblings().removeClass('active menu-open').end().addClass('active menu-open');

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#uploadedimg').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }



    function load_order_daita() {
        var token = $("#token_search").val();
        var url = $("#ajax_url_ajax_check_name").val();
        jQuery.ajax({
            url: url,
            type: 'post',
            dataType: 'html',
            cache: false,
            data: {
                "_token": token,
            },
            success: function (data) {
                if (data != "") {

                    $("#orderCheckMessage").text(data); date

                } else {
                    $("#orderCheckMessage").css('background', 'green');

                }
            }

        });
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
                load_order_daita();

            },
            error: function () {
                alert("حدث خطاما");
            }
        });
    });
    function load_order_modal(auto_serial) {
        var token = $("#token_search").val();
        var url = $("#ajax_get_load_order_update_modal").val();
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

                $("#updateInvoiceModalActiveorderBody").html(data);
                $("#updateInvoiceModalActiveorder").modal("show");
            },
            error: function () {
                /*  alert(auto_serial + "حدث خطاما");*/
            }
        });
    }
    $(document).on('click', '.load_order_update_modal', function (e) {
        var auto_serial = $(this).data("autoserial");
        load_order_modal(auto_serial);
    });
    function load_invoice_Add_modal(itemcard_id) {
        var token = $("#token_search").val();
        var url = $("#ajax_get_load_modal_addActiveInvoice").val();
        jQuery.ajax({
            url: url,
            type: 'post',
            dataType: 'html',
            cache: false,
            data: {
                "_token": token,
                itemcard_id: itemcard_id
            },
            success: function (data) {

                $("#AddNewInvoiceModalActiveInvoiceBody").html(data);
                $("#AddNewInvoiceModalActiveInvoice").modal("show");
                $("#item_quantity").focus();
            },
            error: function () {
                alert(itemcard_id + "حدث خطاما");
            }
        });
    }
    $(document).on('click', '.load_invoice_details_modal', function (e) {
        var itemcard_id = $(this).data("itemcard_id");
        load_invoice_Add_modal(itemcard_id);
    });

    //**************************the load_modal_order_for_user************************************************ */

    function get_inv_itemcard_batches(oldBatchId = null) {

        var item_code = $("#invoiceautoserial").val();
        var store_id = $("#store_id").val();
        var token_search = $("#token_search").val();
        var url = $("#get_item_batches_order").val();
        jQuery.ajax({
            url: url,
            type: 'post',
            dataType: 'html',
            cache: false,
            data: {
                item_code: item_code,
                store_id: store_id,
                "_token": token_search
            },
            success: function (data) {
                $("#tablehiddenDiv").html(data);
                $("#tablehiddenDiv").show();
                $("#activeItemisInInvoiceDiv").hide();

            },
            error: function () {
            }
        });

    }


    $(document).on('change', '#store_id', function (e) {
        get_inv_itemcard_batches();
        /*    var name = $("#store_id").find("option:selected").text();
            $("#storeCheckMessage").text(name);*/
    });
    $(document).on('keypress', '#searchforitem', function (e) {
        if (e.keyCode == 13) {
            var searchtext = $(this).val();
            var token = $("#token_search").val();
            var url = $("#ajax_searchforitems").val();
            jQuery.ajax({
                url: url,
                type: 'post',
                dataType: 'html',
                cache: false,
                data: {
                    "_token": token,
                    searchtext: searchtext
                },
                success: function (data) {
                    $("#searchforitemresultDiv").html(data);
                    var item_code = $("#item_code").val();
                    if (item_code != "") {
                        var token_search = $("#token_search").val();
                        var ajax_get_item_uoms_url = $("#ajax_get_item_uoms").val();
                        jQuery.ajax({
                            url: ajax_get_item_uoms_url,
                            type: 'post',
                            dataType: 'html',
                            cache: false,
                            data: {
                                item_code: item_code,
                                "_token": token_search
                            },
                            success: function (data) {
                                $("#UomDiv").html(data);
                                $("#UomDiv").show();
                                //ثانيا  الكميات بالباتشات للصنف
                                var item_code = $("#item_code").val();
                                var oldBatchId = nuul;
                                var uom_id = $("#uom_id").val();
                                var store_id = $("#store_id").val();
                                if (item_code != "" && uom_id != "" && store_id != "") {
                                    var token_search = $("#token_search").val();
                                    var url = $("#ajax_get_item_batches").val();
                                    jQuery.ajax({
                                        url: url,
                                        type: 'post',
                                        dataType: 'html',
                                        cache: false,
                                        data: {
                                            item_code: item_code,
                                            uom_id: uom_id,
                                            store_id: store_id,
                                            "_token": token_search
                                        },
                                        success: function (data) {
                                            $("#inv_itemcard_batchesDiv").html(data);
                                            $("#inv_itemcard_batchesDiv").show();
                                            if (oldBatchId != null) {
                                                $("#inv_itemcard_batches_autoserial").val(oldBatchId);
                                            }
                                            var item_code = $("#item_code").val();
                                            var uom_id = $("#uom_id").val();
                                            var sales_item_type = $("#sales_item_type").val();
                                            var token = $("#token_search").val();
                                            var url = $("#ajax_get_item_unit_price").val();
                                            jQuery.ajax({
                                                url: url,
                                                type: 'post',
                                                dataType: 'json',
                                                cache: false,
                                                data: {
                                                    item_code: item_code,
                                                    uom_id: uom_id,
                                                    sales_item_type: sales_item_type,
                                                    "_token": token
                                                },
                                                success: function (data) {
                                                    $("#item_price").val(data * 1);
                                                    var item_quantity = $("#item_quantity").val();
                                                    if (item_quantity == "") item_quantity = 0;
                                                    var item_price = $("#item_price").val();
                                                    if (item_price == "") item_price = 0;
                                                    $("#item_total").val((parseFloat(item_quantity) * parseFloat(item_price)) * 1);
                                                    make_enter_add();
                                                },
                                                error: function () {
                                                    $("#item_price").val("");
                                                }
                                            });
                                        },
                                        error: function () {
                                            $("#inv_itemcard_batchesDiv").hide();
                                        }
                                    });
                                } else {
                                    $("#UomDiv").hide();
                                    $("#inv_itemcard_batchesDiv").hide();
                                }
                            },
                            error: function () {
                                $("#UomDiv").hide();
                                alert("حدث خطاما");
                            }
                        });
                    } else {
                        $("#UomDiv").html("");
                        $("#UomDiv").hide();
                        $("#inv_itemcard_batchesDiv").html("");
                        $("#inv_itemcard_batchesDiv").hide();
                    }
                },
                error: function () { }
            });

        }
    });
    $(document).on('change', '#pill_type', function (e) {
        var pill_type = $("#pill_type").val();
        var total_cost = $("#total_cost").val();
        if (pill_type == 1) {
            //cash
            $("#what_paid").val(total_cost * 1);
            $("#what_remain").val(0);
            $("#what_paid").attr("readonly", true);
            recalcualte();
        } else {
            //agel
            $("#what_paid").val(0);
            $("#what_remain").val(total_cost * 1);
            $("#what_paid").attr("readonly", false);
            recalcualte();
        }
    });
    $(document).on('input', '#what_paid', function (e) {
        total_cost = parseFloat($("#total_cost").val());
        treasuries_balance = parseFloat($("#treasuries_balance").val());
        total_cost = parseFloat(total_cost);
        what_paid = $(this).val();
        if (what_paid == "") {
            what_paid = 0;
        }
        what_paid = parseFloat(what_paid);
        var pill_type = $("#pill_type").val();
        if (pill_type == 1) {
            //cash
            if (what_paid < total_cost) {
                alert("عفوا يجب ان يكون المبلغ كاملا مدفوع في حالة ان الفاتورة كاش");
                $("#what_paid").val(total_cost);
            }
        } else {
            if (what_paid >= total_cost) {
                alert("عفوا يجب ان لايكون كل المبلغ  مدفوع في حالة ان الفاتورة اجل");
                $("#what_paid").val(0);
            }
        }
        if (what_paid > total_cost) {
            alert("عفوا لايمكن ان يكون المبلغ المدفوع اكبر من  اجمالي الفاتورة");
            $("#what_paid").val(0);
        }
        recalcualte();
    });

    $(document).on('click', '#DoApproveInvoiceFinally_oroder', function (e) {
        var customer_code = $("#customer_code").val();
        if (customer_code == "") {
            alert("   يجب ان يكون هناك عميل  ");
            $("#customer_code").focus();
            return false;
        }
        var store_id = $("#store_id").val();
        if (store_id == "") {
            alert("من فضلك اختر المخزن   ");
            $("#store_id").focus();
            return false;

        }

        var total_cost_items = $("#total_cost_items").val();
        if (total_cost_items == "") {
            alert("من فضلك ادخل اجمالي الاصناف");
            return false;
        }

        var total_befor_discount = $("#total_befor_discount").val();
        if (total_befor_discount == "") {
            alert("من فضلك ادخل قيمة الاجمالي قبل الخصم   ");
            return false;
        }



        var total_cost = $("#total_cost").val();
        if (total_cost == "") {
            alert("من فضلك ادخل قيمة اجمالي الفاتورة النهائي     ");
            return false;
        }

        var what_paid = $("#what_paid").val();
        var what_remain = $("#what_remain").val();
        var what_paid = $("#what_paid").val();
        if (what_paid == "") {
            alert("من فضلك ادخل المبلغ المدفوع        ");
            return false;
        }
        if (what_paid > total_cost) {
            alert("عفوا لايمكن ان يكون المبلغ المصروف اكبر من اجمالي الفاتورة         ");
            return false;
        }
        if (pill_type == 1) {
            if (parseFloat(what_paid) < parseFloat(total_cost)) {
                alert("عفوا يجب ان يكون كل المبلغ مدفوع في حالة ان الفاتورة كاش       ");
                return false;
            }
        } else {
            if (parseFloat(what_paid) == parseFloat(total_cost)) {
                alert("عفوا لايمكن ان يكون المبلغ المدفوع يساوي اجمالي الفاتورة في حالة ان الفاتورة اجل      ");
                return false;
            }
        }
        var what_remain = $("#what_remain").val();
        if (what_remain == "") {
            alert("من فضلك ادخل المبلغ المتبقي        ");
            return false;
        }
        if (pill_type == 1) {
            if (what_remain > 0) {
                alert("عفوا لايمكن ان يكون المبلغ المتبقي اكبر من الصفر في حالة ان الفاتورة كاش      ");
                return false;
            }
        }
        if (what_paid > 0) {
            var treasuries_id = $("#treasuries_id").val();
            if (treasuries_id == "") {
                alert("من فضلك اختر خزنة التحصيل         ");
                return false;
            }
        }
        var token = $("#token_search").val();
        var url = $("#ajax_DoApproveInvoiceFinally_order").val();
        var id_order = $("#invoiceautoserial").val();
        var date_order = $("#date_order").val();
        var store_id = $("#store_id").val();
        var pill_type = $("#pill_type").val();
        var treasuries_id = $("#treasuries_id").val();
        jQuery.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            cache: false,
            data: {
                "_token": token,
                id_order: id_order,
                date_order: date_order,
                store_id: store_id,
                what_paid: what_paid,
                what_remain: what_remain,
                pill_type: pill_type
            },
            success: function (data) {
                alert("تم ترحيل الطلب الي فواتير المبيعات بنجاح ");
                location.reload();
            },
            error: function () {
                alert("حدث خطاما");
            }
        });
    });

});