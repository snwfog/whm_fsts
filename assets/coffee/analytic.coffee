###############################################################################
# Generate an analytic instance
##############################################################################
$.ajaxSetup({
  cache: false
})

# Get IP address externally
$.get "http://api.hostip.info/get_html.php", (data) ->
  reg = /([\d]{1,3}\.?){4}/ig
  ip = reg.exec(data)
  $.post 'analytic', { "geoip": ip[0] }