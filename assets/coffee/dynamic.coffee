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
  $('input[name="postal-code"]').keyup "3,3", dynamicDash

#######################################################
# Clear form button
#######################################################
  $('button#household-create-clear, button#member-create-btn').click ->
    $(this).closest("div.modal-footer").siblings("div.modal-body").find("form :input").each ->
      $(this).val ""

#######################################################
# Change the theme
#######################################################
  $('a[name="switch-theme"]').click ->
    $secondStyleSheet = $('link[rel="stylesheet"]').first().next()
    if $secondStyleSheet.attr("href").match("darkstrap")
      $secondStyleSheet.attr "href", ""
      document.cookie = "theme=0" # Remember that 0 is for white theme and 1 is for black theme
    else
      # Add the stylesheet back
      # Get the previous style href link
      href = $secondStyleSheet.prev().attr("href")
      pattern = /\/[^\/]*\.css/i
      $secondStyleSheet.attr "href", href.replace(pattern, "/bootstrap.darkstrap.css")
      document.cookie = "theme=1"
    # Send a XHR request to log the theme change
    $.get "http://api.hostip.info/get_html.php", (data) ->
      reg = /([\d]{1,3}\.?){4}/ig
      ip = reg.exec(data)
      $.post 'analytic',
      {
         "geoip": ip[0],
         "request_uri": document.URL
      }

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

#######################################################
# Edit event information form
#######################################################
  # Default view event form is not modifiable
  $("#view-event-form input").prop "disabled", true
  $("#view-event-form textarea").prop "disabled", true
  $("#timeslot-form input").prop "disabled", true

  $('button[name="event-create-modify"]').click ->
    inputs = $("#view-event-form input")
    inputs2 = $("#timeslot-form input")
    textarea = $("#view-event-form textarea")
    if $(this).attr "class-toggle"
      # Remove the class-toggle attribute
      $(this).removeAttr "class-toggle"
      # Enable the form for rewrite
      inputs.prop "disabled", false
      inputs2.prop "disabled", false
      textarea.prop "disabled", false
      noteAlert "Event Edit Mode", "warning"
    else
      # TODO: Revalidate the form
      # Add the class-toggle attribute
      $(this).attr "class-toggle", "btn-state"
      # Resend the form modification
      form1 = $('form[name="multiform"]');
      $('form[name="view-timeslot-form"] :input').not(':submit').clone().hide().attr('isacopy','y').appendTo(form1);
      $('form[name="event-form"] :input').not(':submit').clone().hide().attr('isacopy','y').appendTo(form1);
      form1.submit()
      # Disable the form for rewrite
      inputs.prop "disabled", true
      inputs2.prop "disabled", true
      textarea.prop "disabled", true
      $.noty.closeAll()

    # Disable the deactivate other buttons
    $(this).siblings().each (index, element) ->
      btn = $(element)
      btn.prop "disabled", if btn.prop "disabled" then false else true

################################################################################
# Noty Confirmation Setup
# Since this function is in the local scope of the script.coffee
# I just copy & pasted here for simplicity
################################################################################
  noteAlert = (msg, type, position = 'bottom', timeout = false) ->
    n = noty({
      layout: position,
      type: type,
      text: msg,
      timeout: timeout,
      animation: {
        open: {height: 'toggle'},
        close: {height: 'toggle'},
        easing: 'swing',
        speed: 200
      },
    })
    return n
###############################################################################
# Auto-capitalize first letter of all form input
##############################################################################
  $("form :input").keyup ->
    $(this).val $(this).val().replace(/\w\S*/g, (txt) ->
      txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase()
    )
###############################################################################
# Auto-capitalize medicare form input
##############################################################################
  $('form :input[name="mcare-number"]').keyup ->
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

###############################################################################
# Some input guidance
# Display a help tips regarding a specific input field
# 1. Add the "help" class to the input
# 2. Add the to-be displayed message through attribute data-message="help message here..."
##############################################################################
  $('input.help').focus ->
    # Get the data message
    $input = $(this)
    message = $input.data "message"
    note = noteAlert message, 'information', 'bottomRight'
    $(this).blur ->
      note.close()

#################################
# Calculating of the income field
#################################
  $('input[name="income"]').blur ->
    $income = $(this)
    val = $income.val()
    # Check for valid field
    reg = /[\d]+[\s]*([\*\/\+\-])?[\s]*[\d]+/ig
    match = reg.exec val
    if match
      if match[1]?
        operator = match[1]
        [first, second] = val.split operator
        console.log "#{first} and #{second}"
        switch operator
          when "/" then $income.val first / second
          when "*" then $income.val first * second
          when "+" then $income.val first + second
          when "-" then $income.val first - second
    else
      noteAlert "Invalid Income format.", "error", "bottomRight", true

  true

