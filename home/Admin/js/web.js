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



});