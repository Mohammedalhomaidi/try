$(document).ready(function () {

  $(document).on('input', '#search_by_text', function (e) {
    make_search();
  });
  $(document).on('change', '#permission_rols_id_search', function (e) {
    make_search();
  });




  function make_search() {
    var search_by_text = $("#search_by_text").val();
    var permission_rols_id_search = $("#permission_rols_id_search").val();
    var token_search = $("#token_search").val();
    var ajax_search_url = $("#ajax_search_url").val();

    jQuery.ajax({
      url: ajax_search_url,
      type: 'post',
      dataType: 'html',
      cache: false,
      data: {
        search_by_text: search_by_text, "_token": token_search,
        permission_rols_id_search: permission_rols_id_search,
      },
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
    var permission_rols_id_search = $("#permission_rols_id_search").val();
    var token_search = $("#token_search").val();
    var url = $(this).attr("href");
    jQuery.ajax({
      url: url,
      type: 'post',
      dataType: 'html',
      cache: false,
      data: {
        search_by_text: search_by_text, "_token": token_search,
        permission_rols_id_search: permission_rols_id_search,
      },
      success: function (data) {

        $("#ajax_responce_serarchDiv").html(data);
      },
      error: function () {

      }
    });



  });
  function change() {
    if ($('#checkforupdatepassword').val() == 1) {
      $("#passwordDiv").show();
    } else {
      $("#passwordDiv").hide();

    }
  }
  $(document).on('change', '#checkforupdatepassword', function (e) {
    change();
  });
  $(document).on('click', '.mmm', function (e) {
    change();
  });
});