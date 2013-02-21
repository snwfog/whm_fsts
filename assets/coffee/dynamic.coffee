# This file contains dynamic sugar candy behaviour
$ ->
#######################################################
#  Dynamic adding slashes
#######################################################
  dynamicDash = (event) ->
    patterns = event.data.split ","
    n = $(this).val().replace(/-/g, '').toUpperCase()
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
#  Clear form button
#######################################################
  $('button#household-create-clear').click ->
    $('form[name="household-create"]')[0].reset()

  true
