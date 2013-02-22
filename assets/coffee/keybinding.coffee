#######################################################
# Modal search
#######################################################
$ ->
  $('#search-modal').bind 'hide', ->
    $('#search-modal input').blur()

  $('#search-modal').on 'shown', ->
    $('#search-modal input').focus()

  $('#create-household-modal').on 'shown', ->
    console.log $(this).find("input").first().focus()

  $('#create-household-modal').on 'hide', ->
    $('#create-household-modal input').each ->
      $(this).blur()

  Mousetrap.bind "s", ->
    $('#search-modal').modal()

  Mousetrap.bind "a", ->
    $('#create-household-modal').modal()