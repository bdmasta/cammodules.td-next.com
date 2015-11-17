$(document).ready(
  function()
  {
    $.ajax( {
      type: "GET",
      url: "sites.xml",
      dataType: "xml",
      success: function(xml)
      {
        $(xml).find('office').each(
          function()
          {
            var code = $(this).attr('class');
            var country = $(this).find('country').text();
            var city = $(this).find('city').text();
            var phone = $(this).find('phone').text();
            var fax = $(this).find('fax').text();
            var email = $(this).find('email').text();

            $('<div class="code"></div>').html(code).appendTo('#Div_XML');
            $('<div class="country"></div>').html(country).appendTo('#Div_XML');
            $('<div class="city"></div>').html(city).appendTo('#Div_XML');
            $('<div class="phone"></div>').html(phone).appendTo('#Div_XML');
            $('<div class="fax"></div>').html(fax).appendTo('#Div_XML');
            $('<div class="email"></div>').html(email).appendTo('#Div_XML');
          });
        }
      });
    }
  );
