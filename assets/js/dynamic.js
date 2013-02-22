// Generated by CoffeeScript 1.3.3

$(function() {
  var dynamicDash, noteAlert;
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
  $('button#household-create-clear').click(function() {
    return $('form[name="household-create"]')[0].reset();
  });
  $("#view-household-form input").prop("disabled", true);
  $('button[name="modify-household-btn"]').click(function() {
    var inputs;
    inputs = $("#view-household-form input");
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
  noteAlert = function(msg, type) {
    var n;
    n = noty({
      layout: 'bottom',
      type: type,
      text: msg,
      timeout: false,
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
    return $(this).val($(this).val().toUpperCase());
  });
  return true;
});
