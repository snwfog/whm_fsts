#######################################################
# Modal search
#######################################################
$ ->
  modal = "#create-household-modal,
    #search-modal,
    #add-member-modal"

  Mousetrap.bind "s", ->
    $('#search-modal').modal()

  Mousetrap.bind "a", ->
    $('#create-household-modal').modal()

  Mousetrap.bind "m", ->
    $('#add-member-modal').modal()

  Mousetrap.bind 'right', ->
    $('a#tab2-toggle').tab('show')

  Mousetrap.bind 'left', ->
    $('a#tab1-toggle').tab('show')

  $(modal).on "hide", ->
    $(this).find("form :input").first().focus().blur()

  $(modal).on 'shown', ->
    $inputs = $(this).find("form :input:not(:hidden)")
    $inputs.each ->
      $(this).val ""
    $inputs.first().focus()
