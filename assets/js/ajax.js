// Generated by CoffeeScript 1.3.3
var __slice = [].slice;

$(function() {
  var first, path, pathname, usermap, _ref;
  pathname = $(location).attr("pathname");
  _ref = pathname.split('/'), first = _ref[0], path = 2 <= _ref.length ? __slice.call(_ref, 1) : [];
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
  
    $('#manage-flag-save').click(function() {
    var form = $('#flag-manage');        
    $.ajax({
        url: form.attr('action'),
        type: 'POST',
        data: {
          'flag-descriptor-1': $('input[name="flag-descriptor-1"]').val(),
          'flag-descriptor-2': $('input[name="flag-descriptor-2"]').val(),
          'flag-descriptor-3': $('input[name="flag-descriptor-3"]').val(),            
          'flag-descriptor-4': $('input[name="flag-descriptor-4"]').val()
          },
        success: function(response){            
            
            var newDescriptorName = JSON.parse(response);
            console.log(newDescriptorName['descriptor1']);
            $('input[name="flag-descriptor-1"]').siblings('button').html('<i class="icon-flag icon-white"></i>'+newDescriptorName['descriptor1']+'</button>');
            $('input[name="flag-descriptor-2"]').siblings('button').html('<i class="icon-flag icon-white"></i>'+newDescriptorName['descriptor2']+'</button>');
            $('input[name="flag-descriptor-3"]').siblings('button').html('<i class="icon-flag icon-white"></i>'+newDescriptorName['descriptor3']+'</button>');
            $('input[name="flag-descriptor-4"]').siblings('button').html('<i class="icon-flag icon-white"></i>'+newDescriptorName['descriptor4']+'</button>');
        } 
        });
    });

   
  
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
            return countries.push(country.trim().toUpperCase());
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
            return languages.push(languageObj['name'].trim().toUpperCase());
          });
          return process(languages);
        }
      });
    }
  });
  $("input[name='mother-tongue']").typeahead({
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
            return languages.push(languageObj['name'].trim().toUpperCase());
          });
          return process(languages);
        }
      });
    }
  });
  usermap = {};
  $("input.search-query").typeahead({
    source: function(query, process) {
      return $.ajax({
        url: $(this)[0].$element.data('link') + "/" + query,
        type: 'get',
        dataType: 'json',
        success: function(json) {
          var members;
          members = [];
          usermap = {};
          if (json != null) {
            $.each(json, function(index, member) {
              var mapKey, mapValue;
              mapKey = (member['last_name'] + ", " + member['first_name']).toUpperCase();
              mapValue = {
                household_id: member.household_id,
                member_id: member.id,
                mcare: member.mcare_number
              };
              usermap[mapKey] = mapValue;
              return members.push(mapKey);
            });
            return process(members);
          }
        }
      });
    },
    matcher: function(item) {
      if (!/[a-zA-Z]+/i.exec(this.query.trim())) {
        console.log("RECORDING HOUSEHOLD ID");
        if (usermap[item]['household_id'].indexOf(this.query.trim()) === 0) {
          return true;
        }
      } else {
        if (item.toLowerCase().indexOf(this.query.trim().toLowerCase()) !== -1) {
          return true;
        }
        if (usermap[item]['mcare'].toLowerCase().indexOf(this.query.trim().toLowerCase()) !== -1) {
          return true;
        }
      }
    },
    updater: function(item) {
      var topp, url;
      path = $('div#search-modal .modal-body .form-search').attr("action");
      topp = path.split('/').pop();
      path = path.replace(topp, "");
      if (!(/[\w]/i.exec(item.household_id))) {
        url = "" + path + "household/" + usermap[item].household_id;
      } else {
        url = "" + path + "household/" + usermap[item].household_id + "/" + usermap[item].member_id;
      }
      $(location).attr('href', url);
      $.get(url);
      return item;
    }
  });
  $('input[name="postal-code"]').focus(function() {
    var map;
    map = {};
    $.get('postalcode', function(data) {
      return $.each(data, function(index, value) {
        return $.each(value, function(postalcode, district) {
          return map[postalcode] = district;
        });
      });
    });
    return $('input[name="postal-code"]').keyup(function() {
      var $district, match, reg, val;
      val = $(this).val();
      $district = $('input[name="district"]');
      if (val.length >= 3) {
        reg = /^\w\d\w/i;
        if (reg.exec(val)) {
          match = (reg.exec(val))[0].toUpperCase();
        }
        if (map[match] != null) {
          $district.css('background-color', '');
          return $district.val(map[match]);
        } else {
          $district.css({
            'background-color': '#f1dede'
          });
          return $district.val("Invalid Postal Code");
        }
      }
    });
  });
  return true;
});
