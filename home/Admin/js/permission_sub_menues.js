$(document).ready(function () {
    $(document).on('input', '#search_by_text', function (e) {
        make_search();
    });

    $(document).on('change', '#permission_main_menues_id_search', function (e) {
        make_search();
    });

    function make_search() {
        var search_by_text = $("#search_by_text").val();
        var permission_main_menues_id_search = $("#permission_main_menues_id_search").val();
        var token_search = $("#token_search").val();
        var ajax_search_url = $("#ajax_search_url").val();

        jQuery.ajax({
            url: ajax_search_url,
            type: 'post',
            dataType: 'html',
            cache: false,
            data: { search_by_text: search_by_text, permission_main_menues_id_search: permission_main_menues_id_search, "_token": token_search },
            success: function (data) {

                $("#ajax_responce_serarchDiv").html(data);
            },
            error: function () {

            }
        });

    }




    $(document).on('click', '#ajax_pagination_in_search a ', function (e) {
        e.preventDefault();
        var search_by_text = $("#search_by_text").val();
        var url = $(this).attr("href");
        var token_search = $("#token_search").val();

        jQuery.ajax({
            url: url,
            type: 'post',
            dataType: 'html',
            cache: false,
            data: { search_by_text: search_by_text, "_token": token_search },
            success: function (data) {

                $("#ajax_responce_serarchDiv").html(data);
            },
            error: function () {

            }
        });

    });

    $(document).on('click', '.add_permission_model', function (e) {
        var id = $(this).data("id");

        $('#do_add_permission').attr('data-id', id);
        $('#add_permission_modal').modal("show");
    });




    $(document).on('click', '#do_add_permission  ', function (e) {
        var permission_modal_name = $("#permission_modal_name").val();
        if (permission_modal_name == '') {
            alert("عفواً من فضلك ادخل الاسم");
            $('permission_modal_name').focus();

            return false;
        }

        var permission_sub_menues_id = $(this).data("id");
        var token_search = $("#token_search").val();
        var ajax_load_add_permission = $("#ajax_load_add_permission").val();
        jQuery.ajax({
            url: ajax_load_add_permission,
            type: 'post',
            dataType: 'json',
            cache: false,
            data: {
                permission_sub_menues_id: permission_sub_menues_id,
                "_token": token_search,
                name: permission_modal_name,


            },
            success: function (data) {
                if (data == 'found') {
                    alert("عفواً هذي البيانات مسجلة من قبل !");
                    $("permission_modal_name").val(" ");
                    $("permission_modal_name").focus();

                } else {
                    $("#AddEventMessage").text("تمت اضافة الصلاحية " + permission_modal_name + " بنجاح");
                    $("#AddEventMessage").css('color', 'green');
                    $('#permission_modal_name').val("");
                    $('#permission_modal_name').focus();
                    location.reload();
                }

            },
            error: function () {

                alert("لم تتم الاضافة  من فضلك حاول مرة  اخري");


            }
        });



    });


    $(document).on('click', '.load_edit_permission_btn', function (e) {

        var id = $(this).data('id');
        var token_search = $("#token_search").val();
        var ajax_load_edit_permission = $("#ajax_load_edit_permission").val();
        jQuery.ajax({
            url: ajax_load_edit_permission,
            type: 'post',
            dataType: 'html',
            cache: false,
            data: {
                id: id,
                "_token": token_search,

            },
            success: function (data) {

                $("#edit_permission_modelBody").html(data);
                $("#edit_permission_modal").modal("show");


            },
            error: function () {

                alert(id + "لم تتم الاضافة  من فضلك حاول مرة  اخري");


            }
        });
    });

    $(document).on('click', '#do_edit_permission', function (e) {
        var token = $("#token_search").val();
        var url = $("#ajax_do_edit_permission").val();
        var id = $(this).data("id");
        var name = $('#name_edit').val();
        if (name == "") {
            alert("من فضلك ادخل اسم المهمه");
            $("#name_edit").focus();
            return false;
        }
        jQuery.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            cache: false,
            data: {
                "_token": token,
                id: id,
                name: name
            },
            success: function (data) {

                $("#edit_permission_modal").modal("hide");
                location.reload();
            },
            error: function () {
                alert("حدث خطاما");

            }
        });
    });


});