$ ->

  # Submit the create household form
  $('button#create-household-save').click ->
    $('form[name="household-create"]').submit()

  # Submit the create household member form
  $('button#add-household-member-save').click ->
    $('form[name="member-create"]').submit()
###############################################################################
# Generate an analytic instance
##############################################################################
  $.ajaxSetup({
    cache: false
  })

  $.post('/')

################################################################################
# Noty Confirmation Setup
# Since this function is in the local scope of the script.coffee
# I just copy & pasted here for simplicity
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
    })

  true
