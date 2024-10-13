<?php

function phpmotorsConnect(){
 $server = 'localhost';
 $dbname= 'phpmotors';
 $username = 'iClient';
//  $password = '!KbX!80BduibtkWF'; //I'll change this now (in order to see the error) 
 $password = '9j/zFrqiKbDyB/UB'; //I'll change this now (in order to see the error) 
//  $password = '3icQzOK)637dbDnu'; //I'll change this now (in order to see the error) 
 $dsn = "mysql:host=$server;dbname=$dbname";
 $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

 // Create the actual connection object and assign it to a variable
 try {
  $link = new PDO($dsn, $username, $password, $options);
  return $link;
//   if (is_object($link)) {
//     echo "It worked!";
//   }
} catch(PDOException $e) {
    //   echo "It didn't work, error: " . $e->getMessage();
    header('Location: /phpmotors/view/500.php');
    exit;
 }
}

phpmotorsConnect();
?>