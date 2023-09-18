$(document).ready(function () {

  $(document).on('click', '.review_now', function (e) {
    var id = $(this).data("id");
    var token_search = $("#token_search").val();
    var review_now_url = $("#review_now_url").val();
    jQuery.ajax({
      url: review_now_url,
      type: 'post',
      dataType: 'html',
      cache: false,
      data: {
        id: id,
        "_token": token_search,

      },
      success: function (data) {

        $("#review_nowmodalbody").html(data);
        $("#review_nowmodal").modal("show");
      },
      error: function () {

      }
    });
  });
  $(document).on('change', '#money_state', function (e) {
    var what_realy_delivered = $('#what_realy_delivered').val();
    if (what_realy_delivered == "")
      what_realy_delivered = 0;

    what_realy_delivered = parseFloat(what_realy_delivered);
    var money_should_deviled = $("#money_should_deviled").val();
    if (money_should_deviled > what_realy_delivered) {
      var money_state_value = money_should_deviled - what_realy_delivered;
      $("#money_state").val(1);
      $("#money_state_value").val(money_state_value * 1);
      $("#money_state_valuelabel").text("يوجد عجز بقيمة :" + money_state_value * (1));
      $("#money_state_valueDiv").show();

    } else if (money_should_deviled < what_realy_delivered) {
      var money_state_value = what_realy_delivered - money_should_deviled;
      $("#money_state").val(2);
      $("#money_state_value").val(money_state_value * 1);
      $("#money_state_valuelabel").text("يوجد زيادة بقيمة :" + money_state_value * (1));
      $("#money_state_valueDiv").show();
    } else {
      $("#money_state").val(0);
      $("#money_state_value").val(0);
      $("#money_state_valuelabel").text("حالة اتزان ");
      $("#money_state_valueDiv").show();

    }
  });
  $(document).on('input', '#what_realy_delivered', function (e) {
    var what_realy_delivered = $('#what_realy_delivered').val();
    if (what_realy_delivered == "")
      what_realy_delivered = 0;

    what_realy_delivered = parseFloat(what_realy_delivered);
    var money_should_deviled = $("#money_should_deviled").val();
    if (money_should_deviled > what_realy_delivered) {
      var money_state_value = money_should_deviled - what_realy_delivered;
      $("#money_state").val(1);
      $("#money_state_value").val(money_state_value * 1);
      $("#money_state_valuelabel").text("يوجد عجز بقيمة :" + money_state_value * (1));
      $("#money_state_valueDiv").show();

    } else if (money_should_deviled < what_realy_delivered) {
      var money_state_value = what_realy_delivered - money_should_deviled;
      $("#money_state").val(2);
      $("#money_state_value").val(money_state_value * 1);
      $("#money_state_valuelabel").text("يوجد زيادة بقيمة :" + money_state_value * (1));
      $("#money_state_valueDiv").show();
    } else {
      $("#money_state").val(0);
      $("#money_state_value").val(0);
      $("#money_state_valuelabel").text("حالة اتزان ");
      $("#money_state_valueDiv").show();

    }

  });

  function make_search() {
    var search_by_text = $("#search_by_text").val();
    var searchByBalanceStatus = $("#searchByBalanceStatus").val();
    var searchByactiveStatus = $("#searchByactiveStatus").val();
    var searchbyradio = $("input[type=radio][name=searchbyradio]:checked").val();
    var token_search = $("#token_search").val();
    var ajax_search_url = $("#ajax_search_url").val();

    jQuery.ajax({
      url: ajax_search_url,
      type: 'post',
      dataType: 'html',
      cache: false,
      data: {
        search_by_text: search_by_text, "_token": token_search, searchbyradio: searchbyradio, searchByactiveStatus: searchByactiveStatus
        , searchByBalanceStatus: searchByBalanceStatus
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
    var searchByBalanceStatus = $("#searchByBalanceStatus").val();
    var searchByactiveStatus = $("#searchByactiveStatus").val();
    var searchbyradio = $("input[type=radio][name=searchbyradio]:checked").val();
    var token_search = $("#token_search").val();
    var url = $(this).attr("href");

    jQuery.ajax({
      url: url,
      type: 'post',
      dataType: 'html',
      cache: false,
      data: {
        search_by_text: search_by_text, "_token": token_search, searchbyradio: searchbyradio, searchByactiveStatus: searchByactiveStatus
        , searchByactiveStatus: searchByactiveStatus
      },
      success: function (data) {

        $("#ajax_responce_serarchDiv").html(data);
      },
      error: function () {

      }
    });



  });



});