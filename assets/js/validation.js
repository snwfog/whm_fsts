// Generated by CoffeeScript 1.3.3
/*
Do NOT modify .js file, modify only the .coffee file
This script is used for data validation, and ajax.
This script is NOT for UI, or animation, do that in other script instead.
*/

$(function() {
  var createHouseholdValidator, displayError, noteAlert;
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
      },
      timeout: 5000
    });
  };
  displayError = function(errors) {
    var error, errorString, _i, _len, _results;
    if (errors.length > 0) {
      errorString = "";
      _results = [];
      for (_i = 0, _len = errors.length; _i < _len; _i++) {
        error = errors[_i];
        _results.push(noteAlert(error.message, "warning"));
      }
      return _results;
    }
  };
  /*
     Createhousehold Information
  */

  createHouseholdValidator = new FormValidator("household-create", [
    {
      name: "first-name",
      display: "First Name",
      rules: "required"
    }, {
      name: "last-name",
      display: "Last Name",
      rules: "required"
    }, {
      name: "phone-number",
      display: "Phone Number",
      rules: "callback_check_phone_number"
    }, {
      name: "sin-number",
      display: "Social Insurance",
      rules: "callback_check_sin"
    }, {
      name: "mcare-number",
      display: "Medical Card",
      rules: "callback_check_mcare"
    }, {
      name: "work_status",
      display: "Work Status",
      rules: "exact_length[2]"
    }, {
      name: "gender",
      display: "Gender",
      rules: "exact_length[1]"
    }, {
      name: "welfare-number",
      display: "Welfare Number",
      rules: "callback_check_welfare"
    }, {
      name: "origin",
      display: "Origin",
      rules: "alpha"
    }, {
      name: "language",
      display: "Language",
      rules: "alpha"
    }, {
      name: "marital-status",
      display: "Marital Status",
      rules: "length[2]"
    }, {
      name: "referral",
      display: "Referral",
      rules: "alpha"
    }, {
      name: "contact",
      display: "Contact",
      rules: "alpha"
    }, {
      name: "first-visit-date",
      display: "First Visit Date",
      rules: ""
    }, {
      name: "house-number",
      display: "Number",
      rules: "numeric"
    }, {
      name: "street",
      display: "Street",
      rules: "callback_check_alpha_numeric_space_dash"
    }, {
      name: "apt-number",
      display: "Apartment",
      rules: "alpha_numeric"
    }, {
      name: "city",
      display: "City",
      rules: "alpha"
    }, {
      name: "province",
      display: "Province",
      rules: "exact_length[2]"
    }, {
      name: "postal-code",
      display: "Postal Code",
      rules: "callback_check_postal_code"
    }
  ], displayError);
  createHouseholdValidator.registerCallback('check_phone_number', function(value) {
    var reg;
    console.log(value);
    reg = /([\d]{3}-?){2}-?([\d]{4})/ig;
    if (reg.exec(value)) {
      return true;
    } else {
      return false;
    }
  }).setMessage('check_phone_number', 'Invalid Phone Number format. The valid format should be of <b>###-###-####</b>');
  createHouseholdValidator.registerCallback('check_sin', function(value) {
    var reg;
    console.log(value);
    reg = /([\d]{3}-?){3}/ig;
    if (reg.exec(value)) {
      return true;
    } else {
      return false;
    }
  }).setMessage('check_sin', 'Invalid Social Insurance Number format. The valid format should be of <b>###-###-###</b>.');
  createHouseholdValidator.registerCallback('check_mcare', function(value) {
    var reg;
    console.log(value);
    reg = /([\w]{4}-?([\d]{4}-?){2})/ig;
    if (reg.exec(value)) {
      return true;
    } else {
      return false;
    }
  }).setMessage('check_mcare', 'Invalid Medical Care Number format. The valid format should be of <b>AAAA-####-####</b>.');
  createHouseholdValidator.registerCallback('check_welfare', function(value) {
    var reg;
    console.log(value);
    reg = /([\w]{4}-?[\d]{4}-?\d\d\w\d-?\d\d)/ig;
    if (reg.exec(value)) {
      return true;
    } else {
      return false;
    }
  }).setMessage('check_welfare', 'Invalid Welfare Number format. The valid format should be of <b>AAAA-####-##A#-##</b>.');
  createHouseholdValidator.registerCallback('check_postal_code', function(value) {
    var reg;
    console.log(value);
    reg = /(\w\d\w)-?(\d\w\d)/ig;
    if (reg.exec(value)) {
      return true;
    } else {
      return false;
    }
  }).setMessage('check_postal_code', 'Invalid Postal Code format. The valid format should be of <b>A#A-#A#</b>.');
  return createHouseholdValidator.registerCallback('check_alpha_numeric_space_dash', function(value) {
    var reg;
    reg = /([\w\s\-]+)/ig;
    if (reg.exec(value)) {
      return true;
    } else {
      return false;
    }
  }).setMessage('check_alpha_numeric_space_dash', 'Input contains invalid character(s).');
});
