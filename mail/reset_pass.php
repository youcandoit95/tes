<?php
 require_once "Mail.php";
 
 $from = "No Reply - IT Dev System <itwebdevelopment1@jne.co.id>";
 $to = $_POST['kepada'];
 $subject = $_POST['subject'];
 $url_activation = $_POST['urlactv'];
 $reset_code = $_POST['reset_code'];
 $body = "Silahkan klik link dibawah ini untuk melanjutkan recovery password your account in IT Development System.\n".$url_activation.$reset_code."\nTerima Kasih\n\nBest Regards\nIT Development Robot's";
 
 $host = "192.168.0.249";
 $username = "itwebdevelopment1@jne.co.id";
 $password = "itw1210";
 
 $headers = array ('From' => $from,
   'To' => $to,
   'Subject' => $subject);
 $smtp = Mail::factory('smtp',
   array ('host' => $host,
     'auth' => true,
     'username' => $username,
     'password' => $password));
 
 $mail = $smtp->send($to, $headers, $body);
 
 if (PEAR::isError($mail)) {
   //echo("<p>" . $mail->getMessage() . "</p>");
   echo "0";
  } else {
   //echo("<p>Message successfully sent! $name $url_activation $activation_code</p>");
   echo "1";
  }
 ?>