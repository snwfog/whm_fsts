###
Do NOT modify .js file, modify only the .coffee file
This script is used for data validation, and ajax.
This script is NOT for UI, or animation, do that in other script instead.
###

$ ->

################################################################################
# Noty Confirmation Setup
#
# NOTE TYPE:
#
# [ alert - success - error - warning - information - confirmation ]
################################################################################
  noteAlert = (msg, type) ->
    n = noty({
      layout: 'bottomRight',
      type: type,
      text: msg,
      animation: {
        open: {height: 'toggle'},
        close: {height: 'toggle'},
        easing: 'swing',
        speed: 200
      },
      timeout: 5000
    })

#  noteConfirm = (msg, url) ->
#    n = noty({
#      layout: 'center',
#      type: 'alert',
#      text: msg,
#      modal: true,
#      animation: {
#        open: {height: 'toggle'},
#        close: {height: 'toggle'},
#        easing: 'swing',
#        speed: 50
#      },
#      buttons: [
#        {
#          addClass: 'btn btn-primary', text: 'Continue', onClick: ($noty) ->
#            $noty.close()
#            window.location = url
#        },
#        {
#          addClass: 'btn btn-danger', text: 'Cancel', onClick: ($noty) ->
#            $noty.close()
#        }
#      ]
#    })
#
#  noteFormConfirm = (msg, event) ->
#    n = noty({
#      layout: 'center',
#      type: 'alert',
#      text: msg,
#      modal: true,
#      animation: {
#        open: {height: 'toggle'},
#        close: {height: 'toggle'},
#        easing: 'swing',
#        speed: 50
#      },
#      buttons: [
#        {
#          addClass: 'btn btn-primary', text: 'Continue', onClick: ($noty) ->
#            $noty.close()
#        },
#        {
#          addClass: 'btn btn-danger', text: 'Cancel', onClick: ($noty) ->
#            $noty.close()
#        }
#      ]
#    })

  # Hack to prevent default link follow click through so we
  # can call noty confirmation to follow the link through.
#  $("button.submit").live "click", ->
#    this.blur()
#    console.log "clicked submitable button"
#    false

  # Confirm delete and confirm class link with noty on click
  # Customize the msg when needed.
#  $('.delete').click ->
#    loc = $(this).attr "href"
#    noteConfirm "Are you sure you want to perform a delete?", loc
#
#  $('.confirm').click ->
#    loc = $(this).attr "href"
#    noteConfirm "Are you sure you want to accept this offer?", loc
#
#  $('.warn').click ->
#    loc = $(this).attr "href"
#    noteConfirm "Are you sure to send this warning to owner?", loc
#
#  $('.modify').click ->
#    loc = $(this).attr "href"
##    noteConfirm "Are you sure to modify this post?", loc
#
#################################################################################
## Validator Error Handler
#################################################################################
  displayError = (errors) ->
    if errors.length > 0
      errorString = ""
      for error in errors
        noteAlert error.message, "warning"

  ###
   Createhousehold Information
  ###
  createHouseholdValidator = new FormValidator("household-create", [{
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
    rules: "alpha_numeric"
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
  }], displayError)

  # Custom validator for create household validator
  createHouseholdValidator.registerCallback('check_phone_number', (value) ->
    console.log value
    reg = /([\d]{3}-?){2}-?([\d]{4})/ig
    if reg.exec value then true else false
  ).setMessage('check_phone_number', 'Invalid Phone Number format. The valid format should be of <b>###-###-####</b>')

  createHouseholdValidator.registerCallback('check_sin', (value) ->
    console.log value
    reg = /([\d]{3}-?){3}/ig
    if reg.exec value then true else false
  ).setMessage('check_sin', 'Invalid Social Insurance Number format. The valid format should be of <b>###-###-###</b>.')

  createHouseholdValidator.registerCallback('check_mcare', (value) ->
    console.log value
    reg = /([\w]{4}-?([\d]{4}-?){2})/ig
    if reg.exec value then true else false
  ).setMessage('check_mcare', 'Invalid Medical Care Number format. The valid format should be of <b>AAAA-####-####</b>.')

  createHouseholdValidator.registerCallback('check_welfare', (value) ->
    console.log value
    reg = /([\w]{4}-?[\d]{4}-?\d\d\w\d-?\d\d)/ig
    if reg.exec value then true else false
  ).setMessage('check_welfare', 'Invalid Welfare Number format. The valid format should be of <b>AAAA-####-##A#-##</b>.')

  createHouseholdValidator.registerCallback('check_postal_code', (value) ->
    console.log value
    reg = /((\w\d\w)-?){2}/ig
    if reg.exec value then true else false
  ).setMessage('check_postal_code', 'Invalid Postal Code format. The valid format should be of <b>A#A-#A#</b>.')