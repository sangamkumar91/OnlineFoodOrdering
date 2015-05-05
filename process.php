<?php
  
  $con = mysql_connect('127.0.0.1','root','');
  mysql_select_db('futurecaptcha');

   
   $query = "select * from delivery_men";
  $res = mysql_query($query);
  $ans = "";
  
  ?>

<table>
            <tr>
            <td>Dm_ID</td>
            <td>Status</td>
            <td>Place</td>
            <td>Counter</td>
            <td>Delivery_count</td>
            </tr>

<?php
  while ($row = mysql_fetch_array($res, MYSQL_ASSOC)) {
  	?>
      
        
        
        
            <tr>
            <td><?php echo $row['dm_id']; ?></td>
            <td><input type="text" id="<?php echo "status".$row['dm_id']; ?>" value="<?php echo $row['status']; ?>" onkeyup="counter()"></td>
            <td><input type="text" id="<?php echo "place".$row['dm_id']; ?>" value="<?php echo $row['place']; ?>" readonly></td>
            <td><input type="text" id="<?php echo "counter".$row['dm_id']; ?>" value="<?php echo $row['time_counter']; ?>" readonly></td>
            <td><input type="text" id="<?php echo "dc".$row['dm_id']; ?>" value="<?php echo $row['run']; ?>" readonly></td>
            
            </tr>
            
            

<?php
}
  echo $ans;
   mysql_close($con);
?>
</table>