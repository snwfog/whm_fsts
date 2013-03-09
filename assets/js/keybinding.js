// Generated by CoffeeScript 1.3.3

$(function() {
  var modal;
  modal = "#create-household-modal,    #search-modal,    #add-member-modal";
  Mousetrap.bind("s", function() {
    return $('#search-modal').modal();
  });
  Mousetrap.bind("a", function() {
    return $('#create-household-modal').modal();
  });
  Mousetrap.bind("m", function() {
    return $('#add-member-modal').modal();
  });
  Mousetrap.bind('right', function() {
    return $('a#tab2-toggle').tab('show');
  });
  Mousetrap.bind('left', function() {
    return $('a#tab1-toggle').tab('show');
  });
  $(modal).on("hide", function() {
    return $(this).find("form :input").first().focus().blur();
  });
  return $(modal).on('shown', function() {
    var $inputs;
    $inputs = $(this).find("form :input:not(:hidden)");
    $inputs.each(function() {
      return $(this).val("");
    });
    return $inputs.first().focus();
  });
});
