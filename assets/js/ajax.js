// Generated by CoffeeScript 1.3.3

$(function() {
  var noteAlert;
  $('button#create-household-save').click(function() {
    return $('form[name="household-create"]').submit();
  });
  $('button#add-household-member-save').click(function() {
    return $('form[name="member-create"]').submit();
  });

  $('button#flag-create-save').click(function() {
    var clicked, flagD_id, formElement;
    clicked = $("#flag-types .active").length > 0;
    if (!clicked) {
      alert("Choose a Flag");
    }
    if (clicked) {
      flagD_id = $("#flag-types .active").data("value");
      formElement = document.createElement("input");
      formElement.setAttribute("name", "flag-descriptor-id");
      formElement.setAttribute("type", "hidden");
      formElement.setAttribute("value", flagD_id);
      $('form[name="flag-create-form"]').append(formElement);
      return $('form[name="flag-create-form"]').submit();
    }
  });
  
  noteAlert = function(msg, type) {
    var n;
    return n = noty({
      layout: 'bottomRight',
      type: type,
      text: msg,
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
  };
  return true;
});
