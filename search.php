
<?php

function connect() {
    $con = mysql_connect("localhost", "root", "");
    mysql_select_db("futurecaptcha");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>

        <div id="search">
            <form action="search.php" method="POST">

                <table>
                    <tr>  
                        <td><select name= "location" >
                                <option value="0">Location</option>
                                <?php
                                connect();
                                $query1 = "select distinct business_city from business_info";
                                $result = mysql_query($query1);

                                while ($row = mysql_fetch_array($result)) {
                                    ?>

                                    <option><?php echo $row["business_city"]; ?></option>

                                    <?php mysql_close();
                                }
                                ?>

                            </select></td>
                        <td><select name= "cuisine" >
                                <option value="0">Type Of Cuisine</option>
                                <option value="chinese">Chinese</option>
                                <option value="north indian">North Indian</option>
                            </select></td>
                        <td><input type= "text" placeholder = "Enter Dish Name" name="dish"></td>
                        <td><input id="search_button" type= "submit" value = "Search" name="search"></td>

                    </tr>
                    <tr align="center" >
                        <td><label >Select <br>Your <br> Desired Location</label></td>
                        <td><label>Select <br>Cuisine Type</label></td>
                        <td></td>
                    </tr>
                </table>

            </form>
        </div>
        <?php
        if (isset($_POST["search"])) {
            $location = $_POST["location"];
            $cuisine = $_POST["cuisine"];
            $dish = $_POST["dish"];

            echo $_POST["location"];

            echo $_POST["cuisine"];


            echo $_POST["dish"];
            connect();

          /*  if ($_POST["location"] == 0 && $_POST["cuisine"] == 0 && $_POST["dish"] == FALSE) {
                ?>

                <script>


                    alert("Enter Atleast One Search Field");

                </script>
                <?php
            } 
            else { */
                if ($_POST["dish"] == TRUE) {
                    $query2 = "select * from business_info,products WHERE FIND_IN_SET('$cuisine',business_info.restaurant_cuisine) and business_info.business_city ='$location'
                and products.product_name like '%$dish%' and business_info.location_id = products.location_id";

                    $result2 = mysql_query($query2);

                    $num_rows = mysql_num_rows($result2);
                    echo $num_rows;

                    if ($num_rows != 0) {
                        $i = 1;
                        while ($row = mysql_fetch_array($result2)) {
                            ?>

  <table border="solid" > 
   
   
   <tr>
       <td colspan="8" rowspan="5"><?php echo $i; ?></td>
   </tr>
    
    <tr><td colspan="8" ><?php echo $row['restaurant_timings'] ; ?></td></tr>
    <tr><td colspan="8" ><?php echo $row['cost_for_two'] ; ?></td></tr>
    
    <tr>
        
        <td><?php if($row['restaurant_type']=0){
        ?>   
        <image src="veg.jpg" title="Veg" >
            
            <?php
    }
    else{  
?>   
       <image src="non_veg.jpg" title="Non Veg" >
            
            <?php
        
        
    } ?></td>
        
        <td><?php if ($row['credit_card'] = 0) {
            ?><image src="credit_card.jpg" title="Credit Card" ><?php
        } else {
            ?> <image src="credit_card_no.jpg" title="No Credit Card" ><?php }
        ?></td>
    
    <td><?php if ($row['alcohol_facility'] = 0) {
            ?><image src="alcohol.jpg" title="Alcohol" > <?php
        } else {
            ?> <image src="alcohol_no.jpg" title="No Alcohol" > <?php }
        ?></td>
    
    
    
    <td><?php if ($row['dine_in'] = 0) {
            ?><image src="dinein.jpg" title="Dine In" ><?php
        } else {
            ?> <image src="dinein_no.jpg" title="No Dine In" ><?php }
        ?></td>
    <td><?php if ($row['take_away'] = 0) {
            ?><image src="takeaway.jpg" title="Takeaway" ><?php
        } else {
            ?> <image src="takeaway_no.jpg" title="No takeaway" ><?php }
        ?></td>
    <td><?php if ($row['catering'] = 0) {
            ?><image src="catering.jpg" title="Catering" ><?php
        } else {
            ?><image src="catering_no.jpg" title="No Catering" ><?php }
        ?></td>
    <td><?php if ($row['home_delivery'] = 0) {
            ?><image src="home_delivery.jpg" title="Home Delivery" ><?php
        } else {
            ?> <image src="home_delivery_no.jpg" title="No Home Delivery" ><?php }
        ?></td>
    <td><?php if ($row['air_conditioned'] = 0) {
            ?><image src="AC.jpg" title="Air Conditioned" ><?php
        } else {
            ?> <image src="AC_NO.jpg" title="No Air Conditioning" ><?php }
        ?></td>
    </tr>
    
    <tr>
    <tr><td colspan="3"><?php echo $row['business_building'],$row['business_city'] ;?></td></tr>
    <tr><td colspan="3"><?php echo $row['restaurant_cuisine'] ; ?></td></tr>  
    <tr><td>dssd</td><td>dsdds</td><td>dsaaa</td></tr>
    <tr><td rowspan="3"></td></tr>
</tr>
    
       
   
       
</table>

                    <?php
                    $i++;
                }
            } else {
                $cuisine = $_POST["cuisine"];
                echo "No" + $cuisine + "restuarants available in this location";
            }
        }
        if ($_POST["dish"] == FALSE) {
            $dish = "";
            $query2 = "select * from business_info,products WHERE FIND_IN_SET('$cuisine',business_info.restaurant_cuisine) and business_info.business_city ='$location'
                and products.product_name like '%$dish%' and business_info.location_id = products.location_id";

            $result2 = mysql_query($query2);

            $num_rows = mysql_num_rows($result2);
            if ($num_rows != 0) {
                $i = 1;
                while ($row = mysql_fetch_array($result2)) {
                    ?>

          
  <table border="solid" > 
   
   
   <tr>
       <td colspan="8" rowspan="5"><?php echo $i; ?></td>
   </tr>
    
    <tr><td colspan="8" ><?php echo $row['restaurant_timings'] ; ?></td></tr>
    <tr><td colspan="8" ><?php echo $row['cost_for_two'] ; ?></td></tr>
    
    <tr>
        
        <td><?php if($row['restaurant_type']=0){
        ?>   
        <image src="veg.jpg" title="Veg" >
            
            <?php
    }
    else{  
?>   
       <image src="non_veg.jpg" title="Non Veg" >
            
            <?php
        
        
    } ?></td>
        
        <td><?php if ($row['credit_card'] = 0) {
            ?><image src="credit_card.jpg" title="Credit Card" ><?php
        } else {
            ?> <image src="credit_card_no.jpg" title="No Credit Card" ><?php }
        ?></td>
    
    <td><?php if ($row['alcohol_facility'] = 0) {
            ?><image src="alcohol.jpg" title="Alcohol" > <?php
        } else {
            ?> <image src="alcohol_no.jpg" title="No Alcohol" > <?php }
        ?></td>
    
    
    
    <td><?php if ($row['dine_in'] = 0) {
            ?><image src="dinein.jpg" title="Dine In" ><?php
        } else {
            ?> <image src="dinein_no.jpg" title="No Dine In" ><?php }
        ?></td>
    <td><?php if ($row['take_away'] = 0) {
            ?><image src="takeaway.jpg" title="Takeaway" ><?php
        } else {
            ?> <image src="takeaway_no.jpg" title="No takeaway" ><?php }
        ?></td>
    <td><?php if ($row['catering'] = 0) {
            ?><image src="catering.jpg" title="Catering" ><?php
        } else {
            ?><image src="catering_no.jpg" title="No Catering" ><?php }
        ?></td>
    <td><?php if ($row['home_delivery'] = 0) {
            ?><image src="home_delivery.jpg" title="Home Delivery" ><?php
        } else {
            ?> <image src="home_delivery_no.jpg" title="No Home Delivery" ><?php }
        ?></td>
    <td><?php if ($row['air_conditioned'] = 0) {
            ?><image src="AC.jpg" title="Air Conditioned" ><?php
        } else {
            ?> <image src="AC_NO.jpg" title="No Air Conditioning" ><?php }
        ?></td>
    </tr>
    
    <tr>
    <tr><td colspan="3"><?php echo $row['business_building'],$row['business_city'] ;?></td></tr>
    <tr><td colspan="3"><?php echo $row['restaurant_cuisine'] ; ?></td></tr>  
    <tr><td>dssd</td><td>dsdds</td><td>dsaaa</td></tr>
    
</tr>
    
       
   
       
</table>
                    <?php
                    $i++;
                }
            } else {
                $cuisine = $_POST["cuisine"];
                echo "No" + $cuisine + "restuarants available in this location";
            }
        }
    }

 
?>


    </body>
</html>

