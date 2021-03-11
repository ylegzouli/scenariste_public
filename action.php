/* action.php */

// Process uniquement si POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  print("test");
  // Nom expéditeur
  $nom = strip_tags(trim($_POST["nom"]));
  
  // Email expéditeur
  $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);

  // Message expéditeur
  $message = trim($_POST["message"]);
  
  // Mail destinataire
  $your_email = "ylegzouli@gmail.com";

  // Site destinataire
  $your_site_name = "site-destinataire";
  
  // Sujet email
  $email_subject = "[{$your_site_name}] Nouveau message de {$nom}";
  
  // Contenu email
  $email_content = "Nom: {$nom}<br>";
  $email_content .= "Email: {$email}<br>";
  $email_content .= "Message: {$message}<br>";
  
  // Headers email
  $email_headers  = "MIME-Version: 1.0" . "\r\n";
  $email_headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
  $email_headers .= "From: {$nom} <{$email}>";
  
  // Envoi email
  $send_email = mail($your_email, $email_subject, $email_content, $email_headers);
  
  // Check email envoyé ou non
  if($send_email){
      http_response_code(200);
  } else {
      http_response_code(500);
  }

} else {
  // Non POST -> statut 403
  http_response_code(403);
}