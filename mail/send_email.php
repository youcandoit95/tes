<?php
 require_once "Mail.php";
 
 $from = "No Reply - IT Dev System <itwebdevelopment1@jne.co.id>";
 $to = $_POST['kepada'];
 $subject = $_POST['subject'];
 $name = $_POST['nama'];
 $url_activation = $_POST['urlactv'];
 $activation_code = $_POST['actv_code'];
 $body = "Hi ".$name."! Anda telah mendaftar di IT Development System\nSilahkan klik link dibawah ini untuk aktifasi user anda\n".$url_activation.$activation_code."\nTerima Kasih\n\nBest Regards\nIT Development Robot's";
 
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