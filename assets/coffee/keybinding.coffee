#######################################################
# Modal search
#######################################################
Mousetrap.bind "s", ->
  $('#search-modal').modal()
  $('#search-modal input').focus()


Mousetrap.bind "a", ->
  $('#create-household-modal').modal()