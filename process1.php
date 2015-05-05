<?php
  $key = $_GET['key1'];
  
  $con = mysql_connect('127.0.0.1','root','');
  mysql_select_db('futurecaptcha');
  $query = "select * from delivery_men where dm_id='$key'";
  $res = mysql_query($query);
  $thisstatus=  mysql_result($res,$key,"status");
  if($thisstatus!="free")
  {
      $thisstatus="free";
      $thistime="stop";
  }
  $query= "update delivery_men set status='$thisstatus',time_counter='$thistime',place='',run='0' where dm_id='$key'";
  mysql_query($query);
  
  
  
  
  ?>
<?php
  
  $con = mysql_connect('127.0.0.1','root','');
  mysql_select_db('futurecaptcha');
  $query = "select * from delivery_men";
  $res = mysql_query($query);
  $ans = "";
  while ($row = mysql_fetch_array($res, MYSQL_ASSOC)) {
  	?>
      <table>
            <tr>
            <td>Dm_ID</td>
            <td>Status</td>
            <td>Place</td>
            <td>Counter</td>
            <td>Delivery_count</td>
            </tr>
        
        
        
            <tr>
            <td><?php echo $row['dm_id']; ?></td>
            <td><input type="text" id="<?php echo "status".$row['dm_id']; ?>" value="<?php echo $row['status']; ?>" onkeyup="counter()"></td>
            <td><input type="text" id="<?php echo "place".$row['dm_id']; ?>" value="<?php echo $row['place']; ?>" readonly></td>
            <td><input type="text" id="<?php echo "counter".$row['dm_id']; ?>" value="<?php echo $row['time_counter']; ?>" readonly></td>
            <td><input type="text" id="<?php echo "dc".$row['dm_id']; ?>" value="<?php echo $row['run']; ?>" readonly></td>
            
            </tr>
            
            </table>

<?php
}
  echo $ans;
   mysql_close($con);
?>