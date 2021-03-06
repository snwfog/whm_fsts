// Generated by CoffeeScript 1.3.3

$(function() {
  var dynamicDash, noteAlert, time;
  dynamicDash = function(event) {
    var begin, end, i, n, p, pattern, patterns, _i, _len;
    patterns = event.data.split(",");
    n = $(this).val().toUpperCase().replace(/-/g, '');
    p = "";
    begin = 0;
    end = parseInt(patterns[0]);
    for (i = _i = 0, _len = patterns.length; _i < _len; i = ++_i) {
      pattern = patterns[i];
      if (n.length > end) {
        p += n.substring(begin, end);
        p += "-";
        begin = end;
        end = begin + parseInt(patterns[i + 1]);
      } else {
        break;
      }
    }
    p += n.substring(begin, n.length);
    return $(this).val(p.substring(0, parseInt($(this).attr("maxlength"))));
  };
  $('input[name="phone-number"]').keyup("3,3,4", dynamicDash);
  $('input[name="mcare-number"]').keyup("4,4,4", dynamicDash);
  $('input[name="welfare-number"]').keyup("4,4,4,2", dynamicDash);
  $('input[name="sin-number"]').keyup("3,3,3", dynamicDash);
  $('input[name="postal-code"]').keyup("3,3", dynamicDash);
  $('button#household-create-clear, button#member-create-btn').click(function() {
    return $(this).closest("div.modal-footer").siblings("div.modal-body").find("form :input").each(function() {
      return $(this).val("");
    });
  });
  $('a[name="switch-theme"]').click(function() {
    var $secondStyleSheet, href, pattern;
    $secondStyleSheet = $('link[rel="stylesheet"]').first().next();
    if ($secondStyleSheet.attr("href").match("darkstrap")) {
      $secondStyleSheet.attr("href", "");
      document.cookie = "theme=0";
    } else {
      href = $secondStyleSheet.prev().attr("href");
      pattern = /\/[^\/]*\.css/i;
      $secondStyleSheet.attr("href", href.replace(pattern, "/bootstrap.darkstrap.css"));
      document.cookie = "theme=1";
    }
    return $.get("http://api.hostip.info/get_html.php", function(data) {
      var ip, reg;
      reg = /([\d]{1,3}\.?){4}/ig;
      ip = reg.exec(data);
      return $.post('analytic', {
        "geoip": ip[0],
        "request_uri": document.URL
      });
    });
  });
  $("#view-household-form input, #view-household-form select").prop("disabled", true);
  $('button[name="modify-household-btn"]').click(function() {
    var inputs;
    inputs = $("#view-household-form input, #view-household-form select");
    if ($(this).attr("class-toggle")) {
      $(this).removeAttr("class-toggle");
      inputs.prop("disabled", false);
      noteAlert("Household Edit Mode", "warning");
    } else {
      $(this).attr("class-toggle", "btn-state");
      $(this).closest("form").submit();
      inputs.prop("disabled", true);
      $.noty.closeAll();
    }
    return $(this).siblings().each(function(index, element) {
      var btn;
      btn = $(element);
      return btn.prop("disabled", btn.prop("disabled") ? false : true);
    });
  });
  $("#view-event-form input").prop("disabled", true);
  $("#view-event-form textarea").prop("disabled", true);
  $("#timeslot-form input").prop("disabled", true);
  $('button[name="event-create-modify"]').click(function() {
    var form1, inputs, inputs2, textarea;
    inputs = $("#view-event-form input");
    inputs2 = $("#timeslot-form input");
    textarea = $("#view-event-form textarea");
    if ($(this).attr("class-toggle")) {
      $(this).removeAttr("class-toggle");
      inputs.prop("disabled", false);
      inputs2.prop("disabled", false);
      textarea.prop("disabled", false);
      noteAlert("Event Edit Mode", "warning");
    } else {
      $(this).attr("class-toggle", "btn-state");
      form1 = $('form[name="event-form"]');
      $('form[name="view-timeslot-form"] :input').not(':submit').clone().hide().attr('isacopy', 'y').appendTo(form1);
      form1.submit();
      inputs.prop("disabled", true);
      inputs2.prop("disabled", true);
      textarea.prop("disabled", true);
      $.noty.closeAll();
    }
    $('button#add-timeslot-table').prop("disabled", $('button#add-timeslot-table').prop("disabled") ? true : false);
    return $(this).siblings().each(function(index, element) {
      var btn;
      btn = $(element);
      return btn.prop("disabled", btn.prop("disabled") ? false : true);
    });
  });
  noteAlert = function(msg, type, position, timeout) {
    var n;
    if (position == null) {
      position = 'bottom';
    }
    if (timeout == null) {
      timeout = false;
    }
    n = noty({
      layout: position,
      type: type,
      text: msg,
      timeout: timeout,
      animation: {
        open: {
          height: 'toggle'
        },
        close: {
          height: 'toggle'
        },
        easing: 'swing',
        speed: 200
      }
    });
    return n;
  };
  $("form :input").keyup(function() {
    return $(this).val($(this).val().replace(/\w\S*/g, function(txt) {
      return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
    }));
  });
  $('form :input[name="mcare-number"]').keyup(function() {
     $(this).val($(this).val().toUpperCase());
  });
 
  $('form input[name="mcare-number"]').keyup(function() {
    var date, dob, gender, index, input, month, shard, year, _i, _len, _ref;
    input = $(this).val().split('-');
    if (input.length === 3) {
      for (index = _i = 0, _len = input.length; _i < _len; index = ++_i) {
        shard = input[index];
        switch (index) {
          case 1:
            _ref = shard.match(/[\d]{2}/g), year = _ref[0], month = _ref[1];
            gender = month > 12 ? "F" : "M";
            month %= 50;
            break;
          case 2:
            date = shard.match(/[\d]{2}/g)[0];
        }
      }
      dob = "" + month + "-" + date + "-" + year;
      $(this).closest('form').find('input[name="gender"]').val(gender);
      return $(this).closest('form').find('input[name="date-of-birth"]').val(dob);
    }
  });
  time = function() {
    return $('#navbar-time').html(moment().format("hh:mm:ss A", 1000));
  };
  setInterval(time, 1000);
  time();
  $('input.help').focus(function() {
    var $input, message, note;
    $input = $(this);
    message = $input.data("message");
    note = noteAlert(message, 'information', 'bottomRight');
    return $(this).blur(function() {
      return note.close();
    });
  });
  $('input[name="income"]').blur(function() {
    var $income, first, match, operator, reg, second, val, _ref;
    $income = $(this);
    val = $income.val();
    reg = /[\d]+[\s]*([\*\/\+\-])?[\s]*[\d]+/ig;
    match = reg.exec(val);
    if (match) {
      if (match[1] != null) {
        operator = match[1];
        _ref = val.split(operator), first = _ref[0], second = _ref[1];
        console.log("" + first + " and " + second);
        switch (operator) {
          case "/":
            return $income.val(first / second);
          case "*":
            return $income.val(first * second);
          case "+":
            return $income.val(first + second);
          case "-":
            return $income.val(first - second);
        }
      }
    } else {
      return noteAlert("Invalid Income format.", "error", "bottomRight", true);
    }
  });
  return true;
});

$('#work').change(function() {
  var marker, marker2, marker3, selected_item;
  selected_item = $(this).val();
  if (selected_item === "welfare") {
    marker = $('<span />').insertBefore('#welfare-number');
    $('#welfare-number').detach().attr('type', 'text').insertAfter(marker).focus();
    return marker.remove();
  } else if (selected_item === "student") {
    marker = $('<span />').insertBefore('#school');
    $('#school').detach().attr('type', 'text').insertAfter(marker).focus();
    marker.remove();
    marker2 = $('<span />').insertBefore('#student-id');
    $('#student-id').detach().attr('type', 'text').insertAfter(marker2).focus();
    marker2.remove();
    marker3 = $('<span />').insertBefore('#bursary');
    $('#bursary').detach().attr('type', 'text').insertAfter(marker3).focus();
    marker3.remove();
    marker4 = $('<span />').insertBefore('#grade');
    $('#grade').detach().attr('type', 'text').insertAfter(marker4).focus();
    return marker4.remove();
  }
});
