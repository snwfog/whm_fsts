$ ->

  # Submit the create household form
  $('button#create-household-save').click ->
    $('form[name="household-create"]').submit()

  # Submit the create household member form
  $('button#add-household-member-save').click ->
    $('form[name="member-create"]').submit()

  $('button#flag-create-save').click ->
    clicked = $("#flag-types .active").length > 0;
    alert("Choose a Flag") if not clicked
    if clicked
        flagD_id = $("#flag-types .active").data("value")
        formElement = document.createElement("input")
        formElement.setAttribute("name", "flag-descriptor-id")
        formElement.setAttribute("type", "hidden");
        formElement.setAttribute("value", flagD_id)
        $('form[name="flag-create-form"]').append(formElement)  
        $('form[name="flag-create-form"]').submit()

  $('button.flag-delete-btn').click ->
    console.log "trying to delete a flag"
    $form = $(this).siblings("form")
    $.ajax({
      url: 'flag',
      data: $form.serialize(),
      type: 'DELETE',
      success: ->
        $group = $form.parents('div.accordion-group')
        $group.remove()
    })



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
