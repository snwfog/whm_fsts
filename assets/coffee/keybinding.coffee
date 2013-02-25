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

  $(modal).on "hide", ->
    $(this).find("form :input").first().focus().blur()

  $(modal).on 'shown', ->
    $(this).find("form :input").each ->
      $(this).val ""
    $(this).find("input").first().focus()
