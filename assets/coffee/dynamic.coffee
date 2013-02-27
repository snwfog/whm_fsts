# This file contains dynamic sugar candy behaviour
$ ->

#######
# Change active bebaviour of member buttons
#######

#######################################################
# Dynamic adding slashes
#######################################################
  dynamicDash = (event) ->
    patterns = event.data.split ","
    n = $(this).val().toUpperCase().replace(/-/g, '')
    p = ""
    begin = 0
    end = parseInt patterns[0]

    for pattern, i in patterns
      if n.length > end
        p += n.substring begin, end
        p += "-"
        begin = end
        end = begin + parseInt patterns[i + 1]
      else
        break

    p += n.substring begin, n.length
    $(this).val p.substring 0, parseInt $(this).attr("maxlength")

  $('input[name="phone-number"]').keyup "3,3,4", dynamicDash
  $('input[name="mcare-number"]').keyup "4,4,4", dynamicDash
  $('input[name="welfare-number"]').keyup "4,4,4,2", dynamicDash
  $('input[name="sin-number"]').keyup "3,3,3", dynamicDash

#######################################################
# Clear form button
#######################################################
  $('button#household-create-clear, button#member-create-btn').click ->
    $(this).closest("div.modal-footer").siblings("div.modal-body").find("form :input").each ->
      $(this).val ""

#######################################################
# Change the theme
#######################################################

#######################################################
# Edit household information form
#######################################################
  # Default view household form is not modifiable
  $("#view-household-form input").prop "disabled", true
  $('button[name="modify-household-btn"]').click ->
    inputs = $("#view-household-form input")
    if $(this).attr "class-toggle"
      # Remove the class-toggle attribute
      $(this).removeAttr "class-toggle"
      # Enable the form for rewrite
      inputs.prop "disabled", false
      noteAlert "Household Edit Mode", "warning"
    else
      # TODO: Revalidate the form
      # Add the class-toggle attribute
      $(this).attr "class-toggle", "btn-state"
      # Resend the form modification
      $(this).closest("form").submit()
      # Disable the form for rewrite
      inputs.prop "disabled", true
      $.noty.closeAll()

    # Disable the deactivate and add member button
    $(this).siblings().each (index, element) ->
      btn = $(element)
      btn.prop "disabled", if btn.prop "disabled" then false else true

################################################################################
# Noty Confirmation Setup
# Since this function is in the local scope of the script.coffee
# I just copy & pasted here for simplicity
################################################################################
  noteAlert = (msg, type) ->
    n = noty({
      layout: 'bottom',
      type: type,
      text: msg,
      timeout: false,
      animation: {
        open: {height: 'toggle'},
        close: {height: 'toggle'},
        easing: 'swing',
        speed: 200
      },
    })
    return n
###############################################################################
# Auto-capitalize all form input
##############################################################################
  $("form :input").keyup ->
    $(this).val $(this).val().toUpperCase()

###############################################################################
# Auto filling gender and date of birth from medical care number
##############################################################################
  $('form input[name="mcare-number"]').keyup ->
    input = $(this).val().split('-')
    if input.length == 3
      for shard, index in input
        switch index
          # Handle birth year, month and gender
          when 1
            [ year, month ] = shard.match /[\d]{2}/g
            gender = if month > 12 then "F" else "M"
            month %= 50
          when 2
            date = shard.match(/[\d]{2}/g)[0]

      dob = "#{month}-#{date}-#{year}"
      $(this).closest('form').find('input[name="gender"]').val gender
      $(this).closest('form').find('input[name="date-of-birth"]').val dob

###############################################################################
# Create time clock in the navbar
##############################################################################
  time = -> $('#navbar-time').html moment().format "hh:mm:ss A", 1000
  setInterval time, 1000
  time()

  # Popover test for flags - temporary - charles
  $("div.notes").popover({
    'trigger': 'hover',
  })


  true

