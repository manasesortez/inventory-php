<?php

try{
    
  $pdo = new PDO('mysql:host=localhost:3307;dbname=pos_db','root','');
//echo'Connection Successfull'; 
    
}catch(PDOException $f){
    
    echo $f->getmessage();
    
}

 




?>