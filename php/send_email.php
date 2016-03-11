<?php

require 'connection_bdd.php';

$reponse = $bdd->query('SELECT * FROM contact, country WHERE country.id_contact = contact.id_contact ORDER BY country.id_country');

$emails=array();
$i = 1;
while ($donnees = $reponse->fetch(PDO::FETCH_ASSOC)) {
$emails[$i] = $donnees['email_contact'];
$i++;

}

// Check for empty fields
if(empty($_POST['firstname']) ||
empty($_POST['name'])  ||
empty($_POST['email']) ||
empty($_POST['company']) ||
empty($_POST['routing']) && !isset($emails[$_POST['routing']]) ||
empty($_POST['topic']) ||
empty($_POST['message']))
{
  $result = 'Please fill out all required fields';
}

elseif(!empty($_POST['address']))
{
  $result = 'This email has been sent by a robot!';
}

elseif (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
{
  $result = 'Please fill in a valid email address';
  return false;
}

else {
  $firstname = htmlspecialchars($_POST['firstname']);
  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $company = htmlspecialchars($_POST['company']);
  $routing = htmlspecialchars($emails[$_POST['routing']]);
  $topic = htmlspecialchars($_POST['topic']);
  $message = htmlspecialchars($_POST['message']);

  $copy = 'michael.uyttersprot@avnet.eu';
  $blind_copy1= 'bdumontet@telecomdesign.fr';
  $blind_copy2= 'michael.uyttersprot@avnet.eu';

  // Create the email and send the message
  $to = $routing ; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
  $email_subject = "[TD next camera modules] $firstname $name from $company";
  $email_body = '
  <html>
  <body>
  <p>You have just received an email from the TD next camera modules website. Please handle this customer request.</p>
  <span><strong>Local office contact email</strong></span>: '.$routing.'<br>
  <span><strong>Firstname</strong></span>: '.$firstname.'<br>
  <span><strong>Name</strong></span>: '.$name.'<br>
  <span><strong>Email</strong></span>: '.$email.'<br>
  <span><strong>Company</strong></span>: '.$company.'<br>
  <span><strong>Topic</strong></span>: '.$topic.'<br>
  <span><strong>Message</strong></span>:
  <p>'.$message.'</p>
  </body>
  </html>
  '
  ;

  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
  $headers .= "Content-Transfer-Encoding: 8bit" . "\r\n";
  $headers .= "From: $email" . "\r\n";
  $headers .= "Reply-To: $email" . "\r\n";
  $headers .= 'Bcc: '.$blind_copy1 . ',' . $blind_copy2 . "\r\n";

  mail($to,$email_subject,$email_body,$headers);
  $result = 'ok';

}
echo json_encode(['result' => $result]);
?>
