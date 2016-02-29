$(document).ready(function(){

  var $routing = $('#routing');

   // chargement des régions
   $.ajax({
       url: '././php/get_countries.php',
       data: 'go', // on envoie $_GET['go']
       dataType: 'json', // on veut un retour JSON
       success: function(json) {
           $.each(json, function(index, value) { // pour chaque noeud JSON
               // on ajoute l option dans la liste
               $routing.append('<option value="'+ index +'">'+ value +'</option>');
           });
       }
   });
  });


$(document).ready(function(){
  $('#commentForm').submit(function(){
    event.preventDefault();
    routing = $("#routing").val();
    firstname = $("#firstname").val();
    name = $("#name").val();
    email = $("#email").val();
    company = $("#company").val();
    address = $("#address").val();
    topic = $("#topic").val();
    message = $("#message").val();

    $.ajax({
      url: "././php/send_email.php",
      type: "POST",
      data: {
        routing:routing,
        firstname:firstname,
        name:name,
        email:email,
        address:address,
        company:company,
        topic:topic,
        message:message
      },
      dataType: 'json',
      success: function(json) {
        if(json.result === 'ok') {
          $('#success').html("<div class='alert alert-tdnext alert-tdnext-success'>");
          $('#success > .alert-tdnext-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
          .append("</button>");
          $('#success > .alert-tdnext-success')
          .append("Your message has been sent.");
          $('#success > .alert-tdnext-success')
          .append('</div>');

          $('#contact')[0].reset();
        }
        else {
          $('#success').html("<div class='alert alert-tdnext alert-tdnext-danger'>");
          $('#success > .alert-tdnext-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
          .append("</button>");
          $('#success > .alert-tdnext-danger').append(+ json.result);
          $('#success > .alert-tdnext-danger').append('</div>');
        }
      },
      error: function() {
        // Fail message
        $('#success').html("<div class='alert alert-tdnext alert-tdnext-danger'>");
        $('#success > .alert-tdnext-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
        .append("</button>");
        $('#success > .alert-tdnext-danger').append("Sorry, it seems that the mail server is not responding. Please try again later!");
        $('#success > .alert-tdnext-danger').append('</div>');

        $('#contact')[0].reset();
      },
    })
  });

  $('#address').hide();

});
