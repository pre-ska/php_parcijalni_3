<?php
      $host='localhost';
      $user='root'; 
      $password=''; 
      $database='fakultet'; 
      $mysqli= new mysqli($host, $user, $password, $database);
      
      if(mysqli_connect_errno()){
        echo "Ne mogu se spojiti na bazu podataka<br>";
        echo mysqli_connect_error();
        exit;  
      }

?>