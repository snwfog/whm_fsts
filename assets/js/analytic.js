// Generated by CoffeeScript 1.3.3

$.ajaxSetup({
  cache: false
});

$.get("http://api.hostip.info/get_html.php", function(data) {
  var ip, reg;
  reg = /([\d]{1,3}\.?){4}/ig;
  ip = reg.exec(data);
  return $.post('analytic', {
    "geoip": ip[0],
    "request_uri": document.URL
  });
});
