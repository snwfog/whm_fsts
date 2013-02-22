#######################################################
# Modal search
#######################################################
$ ->
  $('#search-modal').bind 'hide', ->
    $('#search-modal input').blur()

  $('#search-modal').on 'shown', ->
    $('#search-modal input').focus()

  Mousetrap.bind "s", ->
    $('#search-modal').modal()


  Mousetrap.bind "a", ->
    $('#create-household-modal').modal()