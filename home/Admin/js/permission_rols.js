$(document).ready(function () {


    $(document).on('click', '.load_add_permission_rols_sub_menues', function (e) {



        var id = $(this).data("id");
        var token_search = $("#token_search").val();
        var ajax_load_add_permission = $("#load_add_permission_rols_sub_menues").val();
        jQuery.ajax({
            url: ajax_load_add_permission,
            type: 'post',
            dataType: 'html',
            cache: false,
            data: {
                id: id,
                "_token": token_search,


            },
            success: function (data) {

                $('#load_add_permission_rols_sub_menuesbody').html(data);
                $('#load_add_permission_rols_sub_menuesmodal').modal("show");
                $('.select2').select2({
                    theme: 'bootstrap4'
                });


            },
            error: function (data) {

                alert(id + "لم تتم الاضافة  من فضلك حاول مرة  اخري");


            }
        });



    });

    $(document).on('click', '.load_add_permission_rols_sub_menues_action', function (e) {
        var id = $(this).data("id");
        var token_search = $("#token_search").val();
        var ajax_load_add_permission = $("#load_add_permission_rols_sub_menues_action").val();
        jQuery.ajax({
            url: ajax_load_add_permission,
            type: 'post',
            dataType: 'html',
            cache: false,
            data: {
                id: id,
                "_token": token_search,


            },
            success: function (data) {

                $('#load_add_permission_rols_sub_menues_actionBody').html(data);
                $('#load_add_permission_rols_sub_menues_actionmodal').modal("show");

                $('.select2').select2({
                    theme: 'bootstrap4'
                });

            },
            error: function (data) {

                alert(id + "لم تتم الاضافة  من فضلك حاول مرة  اخري");


            }
        });



    });


});