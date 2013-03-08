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

  noteAlert("World", "success")

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
#  displayError = (errors) ->
#    if errors.length > 0
#      errorString = ""
#      for error in errors
#        noteAlert error.message, "warning"
#    else
#      return confirm "Ready to submit your form?"
#
#  ###
#    Createhousehold Information
#  ###
#  createHouseholdValidator = new FormValidator("household-create-form", [{
#    name: "first-name",
#    display: "First Name",
#    rules: "required"
#  }, {
#    name: "last-name",
#    display: "Last Name",
#    rules: "required"
#  }, {
#    name: "phone-number",
#    display: "Phone Number",
#    rules: "numeric|phone_number"
#  }, {
#    name: "sin-number",
#    display: "Social Insurance",
#    rules: "sin_number"
#  }, {
#    name: "mcare-number",
#    display: "Medical Card",
#    rules: "mcare_number"
#  }, {
#    name: "work_status",
#    display: "Work Status",
#    rules: "required"
#  }, {
#    name: "gender",
#    display: "Gender",
#    rules: "required|exact_length[1]"
#  }, {
#    name: "welfare-number",
#    display: "Welfare Number",
#    rules: "required|numeric"
#  }, {
#    name: "origin",
#    display: "Origin",
#    rules: "required"
#  }, {
#    name: "language",
#    display: "Language",
#    rules: "required"
#  }, {
#    name: "marital-status",
#    display: "Marital Status",
#    rules: "required|length[2]"
#  }, {
#    name: "referral",
#    display: "Referral",
#    rules: "alpha"
#  }, {
#    name: "contact",
#    display: "Contact",
#    rules: "alpha"
#  }, {
#    name: "first-visit-date",
#    display: "First Visit Date",
#    rules: "required|alpha_dash"
#  }, {
#    name: "house-number",
#    display: "Number",
#    rules: "required|alpha_numeric"
#  }, {
#    name: "street",
#    display: "Street",
#    rules: "required|alpha_numeric"
#  }, {
#    name: "apt-number",
#    display: "Apartment",
#    rules: "alpha_numeric"
#  }, {
#    name: "city",
#    display: "City",
#    rules: "required|alpha"
#  }, {
#    name: "province",
#    display: "Province",
#    rules: "required"
#  }, {
#    name: "postal-code",
#    display: "Postal Code",
#    rules: "required|postal_code"
#  }], displayError)
