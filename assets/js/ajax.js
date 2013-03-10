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
  $('button.flag-delete-btn').click(function() {
    var $form;
    console.log("trying to delete a flag");
    $form = $(this).siblings("form");
    return $.ajax({
      url: 'flag',
      data: $form.serialize(),
      type: 'DELETE',
      success: function() {
        var $group;
        $group = $form.parents('div.accordion-group');
        return $group.remove();
      }
    });
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
  /*
    Bootstrap Typeahead for ORIGINS and LANGUAGES
    Sexy way of doing typeahead with ajax & bootstrap
    http://stackoverflow.com/questions/9232748/twitter-bootstrap-typeahead-ajax-example
    http://tatiyants.com/how-to-use-json-objects-with-twitter-bootstrap-typeahead/
  */

  $("input[name='origin']").typeahead({
    source: function(query, process) {
      return $.ajax({
        url: $(this)[0].$element.data('link'),
        type: 'get',
        data: {
          query: query
        },
        dataType: 'json',
        success: function(json) {
          var countries;
          countries = [];
          $.each(json, function(code, country) {
            return countries.push(country.trim());
          });
          return process(countries);
        }
      });
    }
  });
  $("input[name='language']").typeahead({
    source: function(query, process) {
      return $.ajax({
        url: $(this)[0].$element.data('link'),
        type: 'get',
        data: {
          query: query
        },
        dataType: 'json',
        success: function(json) {
          var languages;
          languages = [];
          $.each(json, function(name, languageObj) {
            return languages.push(languageObj['name'].trim());
          });
          return process(languages);
        }
      });
    }
  });
  return true;
});
