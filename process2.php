<?php
  $key = $_GET['key1'];
  
  $con = mysql_connect('127.0.0.1','root','');
  mysql_select_db('futurecaptcha');
  
  $query= "update delivery_men set status='left' where dm_id='$key'";
  mysql_query($query);
  
  
  

?>
