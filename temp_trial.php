<?php
session_start();

ob_start();
if($_SESSION['log']==false)
{
    /*if(isset($_SESSION['msg']))
    {
        echo $_SESSION['msg'];
    }*/
    $_SESSION = array();
    $para = session_get_cookie_params();
    setcookie(session_name(),'',time()-60*60,$para['path'], $para['domain']);
    session_destroy();
}

if($_SESSION['log']==true)
{
    //echo 'Welcome '.$_SESSION['cust_name'].'<br>';
    
   /* if(isset($_SESSION['sign']))
    {
        echo $_SESSION['sign'];
    }*/
}
else
{
    if(isset($_SESSION['msg_temp']))
    {
        echo $_SESSION['msg_temp'];
    }
}


if(isset($_SESSION['loc_id']))
{
    unset($_SESSION['loc_id']);
}
require 'header1.php';
?>

<?php

function search($query2) {

    mysql_connect("localhost", "root", "");
    mysql_select_db("futurecaptcha");
    $result2 = mysql_query($query2);

    $num_rows = mysql_num_rows($result2);
    if ($num_rows != 0) {
        $i = 1;
        while ($row = mysql_fetch_array($result2)) {
            ?>
            <h1><br></h1>
            <div id="searchresult" >

                <table id="searchresulttable" >
                    <tr>
                        <td rowspan="6"><?php echo $i ?></td>
                        <td rowspan="2" colspan="3"><?php
            $website = $row['website_id'];
            $temp = "select distinct website_domain from websites where website_id= '$website'";
            $resulttemp = mysql_query($temp);
            while ($rowtemp = mysql_fetch_array($resulttemp)) {
                ?> <a href="info.php?loc_id=<?php echo $row['location_id'] ?>"><?php echo $rowtemp['website_domain']; ?></a>  <?php
            }
            ?></td>

                        <td rowspan="6" ><a href="gallery.php?loc_id=<?php echo $row['location_id'] ?> "> <image id="thumbnail" src="<?php echo $row['thumbnail'] ?>"  title="thumbnail" ></a></td>
                        <td colspan="4"><?php echo $row['restaurant_timings']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="4"><?php echo $row['cost_for_two']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="3"><?php echo $row['business_building'], $row['business_city']; ?></td>
                        <td rowspan="2"><?php if ($row['restaurant_type'] == "veg") {
                    ?>   
                                <image src="images\veg.jpg" title="Veg" >
                                <?php
                            } else {
                                ?>   
                                <image src="images\non_veg.jpg" title="Non Veg" >
                            <?php }
                            ?></td>
                        <td rowspan="2"><?php if ($row['credit_card'] == 1) {
                    ?><image src="images\credit_card.jpg" title="Credit Card" ><?php
                } else {
                                ?> <image src="images\credit_card_no.jpg" title="No Credit Card" ><?php }
                            ?></td>
                        <td rowspan="2"><?php if ($row['alcohol_facility'] == 1) {
                    ?><image src="images\alcohol.jpg" title="Alcohol" > <?php
                } else {
                                ?> <image src="images\alcohol_no.jpg" title="No Alcohol" > <?php }
                            ?></td>
                        <td rowspan="2"><?php if ($row['dine_in'] == 1) {
                    ?><image src="images\dinein.jpg" title="Dine In" ><?php
                } else {
                                ?> <image src="images\dinein_no.jpg" title="No Dine In" ><?php }
                            ?></td>
                    </tr>
                    <tr>
                        <td colspan="3"><?php echo $row['restaurant_cuisine']; ?></td>
                    </tr>
                    <tr>
                        <td rowspan="2"><a href="menu.php?loc_id=<?php echo $row['location_id'] ?> " ><image src="images\order.jpg" title="order" ></a></td>
                        <td rowspan="2"><a href="menu.php?loc_id=<?php echo $row['location_id'] ?> " ><image src="images\menu.jpg"  title="menu" ></a></td>
                        <td rowspan="2"><a href="info.php?loc_id=<?php echo $row['location_id'] ?> " ><image src="images\navigation.jpg"  title="Navigation" ></a></td>
                        <td rowspan="2"><?php if ($row['take_away'] == 1) {
                    ?><image src="images\take_away.jpg" title="Takeaway" ><?php
                } else {
                                ?> <image src="images\take_away_no.jpg" title="No takeaway" ><?php }
                            ?></td>
                        <td rowspan="2"><?php if ($row['catering'] == 1) {
                    ?><image src="images\catering.jpg" title="Catering" ><?php
                } else {
                                ?><image src="images\catering_no.jpg" title="No Catering" ><?php }
                            ?></td>
                        <td rowspan="2"><?php if ($row['home_delivery'] == 1) {
                    ?><image src="images\home_delivery.jpg" title="Home Delivery" ><?php
                } else {
                                ?> <image src="images\home_delivery_no.jpg" title="No Home Delivery" ><?php }
                            ?></td>
                        <td rowspan="2"><?php if ($row['air_conditioned'] == 1) {
                    ?><image src="images\AC.jpg" title="Air Conditioned" ><?php
                } else {
                                ?> <image src="images\AC_NO.jpg" title="No Air Conditioning" ><?php }
                            ?></td>
                    </tr>



                </table>
            </div>
            
            <?php
            $i++;
        }
    } else {
        $cuisine = $_GET["cuisine"];
        echo "No" . $cuisine . "restuarants available in this location";
    }
}
?>    

<?php

function connect() {
    $con = mysql_connect("localhost", "root", "");
    mysql_select_db("futurecaptcha");
}
/*
if(isset($_SESSION['nonce1']))
{
    if ($_SESSION['nonce1'] != $_POST['nonce1']) {
        header('Location: temp.php');
        die();
    } else {
    // clear the session nonce
        unset($_SESSION['nonce1']);
    }
}
else
{
$_SESSION['nonce1'] = $nonce1 = md5(rand());
}


*/



?>
            
            <h1>FIND FOOD AROUND YOU!</h1>


            <div id="search">
                <form action="temp.php" method="GET">
<div id="searchform">
                    <table >
                        <tr>  
                            <td><select name= "location" >
                                    <option value="10">Location</option>
                                    <?php
                                    connect();
                                    $query1 = "select distinct business_city from business_info";
                                    $result = mysql_query($query1);

                                    while ($row = mysql_fetch_array($result)) {
                                        ?>

                                        <option value="<?php echo $row["business_city"]; ?>" ><?php echo $row["business_city"]; ?></option>

                                        <?php
                                        mysql_close();
                                    }
                                    ?>

                                </select></td>
                            <td><select name= "cuisine" >
                                    <option value="10">Type Of Cuisine</option>
                                    <option value="chinese">Chinese</option>
                                    <option value="north indian">North Indian</option>
                                </select></td>
                            <td><input id="search_text" type= "text" placeholder="Enter Dish" name="dish"></td>
                            <td  ><input id="search_button" type= "submit" value = "" name="search"></td>
                            <!--<input type="hidden" name="nonce1" value="<?php //echo $nonce1; ?>" />-->

                        </tr>
                        <tr align ="center" >
                            <td><label >Select <br>Your <br> Desired Location</label></td>
                            <td><label>Select <br>Cuisine Type</label></td>
                            <td><label>Enter <br>Desired Dish</label></td>
                        </tr>
                    </table>

    </div>
                </form>
            </div>

            <?php
            
            if (isset($_GET["search"])) {
                $location = $_GET["location"];
                $cuisine = $_GET["cuisine"];
                $dish = $_GET["dish"];

                if ($_GET["dish"]) {

                    if ($_GET["location"] == 10 && $_GET["cuisine"] == 10) {
                        //echo "001";
                        $query = "select business_info.location_id,`website_id`,`thumbnail`, `business_name`, `business_building`, `business_street`, `business_city`, `business_state`, `business_zipcode`, `business_countrycode`, `business_contact`, `restaurant_type`, `restaurant_timings`, `minimum_delivery_km`, `minimum_delivery_cost`, `restaurant_cuisine`, `delivery_charges`, `alcohol_facility`, `dine_in`, `catering`, `credit_card`, `cost_for_two`, `air_conditioned`, `tax`, `take_away`, `home_delivery` from business_info,products WHERE products.product_name like '%$dish%' and business_info.location_id = products.location_id";

                        search($query);
                    }
                    if ($_GET["location"] != 10 && $_GET["cuisine"] == 10) {
                        //echo "101";
                        $query = "select business_info.location_id,`website_id`,`thumbnail`, `business_name`, `business_building`, `business_street`, `business_city`, `business_state`, `business_zipcode`, `business_countrycode`, `business_contact`, `restaurant_type`, `restaurant_timings`, `minimum_delivery_km`, `minimum_delivery_cost`, `restaurant_cuisine`, `delivery_charges`, `alcohol_facility`, `dine_in`, `catering`, `credit_card`, `cost_for_two`, `air_conditioned`, `tax`, `take_away`, `home_delivery` from business_info,products WHERE  business_info.business_city ='$location'
                and products.product_name like '%$dish%' and business_info.location_id = products.location_id";

                        search($query);
                    }
                    if ($_GET["location"] == 10 && $_GET["cuisine"] != 10) {
                        //echo "011";
                        $query = "select distinct business_info.location_id,`website_id`,`thumbnail`, `business_name`, `business_building`, `business_street`, `business_city`, `business_state`, `business_zipcode`, `business_countrycode`, `business_contact`, `restaurant_type`, `restaurant_timings`, `minimum_delivery_km`, `minimum_delivery_cost`, `restaurant_cuisine`, `delivery_charges`, `alcohol_facility`, `dine_in`, `catering`, `credit_card`, `cost_for_two`, `air_conditioned`, `tax`, `take_away`, `home_delivery` from business_info,products WHERE (FIND_IN_SET('$cuisine',business_info.restaurant_cuisine) or  products.product_name like '%$dish%') and business_info.location_id = products.location_id";

                        search($query);
                    }

                    if ($_GET["location"] != 10 && $_GET["cuisine"] != 10) {
//echo "111";
                        $query = "select distinct business_info.location_id,`website_id`,`thumbnail`, `business_name`, `business_building`, `business_street`, `business_city`, `business_state`, `business_zipcode`, `business_countrycode`, `business_contact`, `restaurant_type`, `restaurant_timings`, `minimum_delivery_km`, `minimum_delivery_cost`, `restaurant_cuisine`, `delivery_charges`, `alcohol_facility`, `dine_in`, `catering`, `credit_card`, `cost_for_two`, `air_conditioned`, `tax`, `take_away`, `home_delivery` from business_info,products where business_info.business_city ='$location' and (FIND_IN_SET('$cuisine',business_info.restaurant_cuisine)
                or products.product_name like '%$dish%') and business_info.location_id = products.location_id";

                        search($query);
                    }
                }

                if (!$_GET["dish"]) {


                    if ($_GET["location"] == 10 && $_GET["cuisine"] == 10) {
                        ?>

                        <script>


                            alert("Enter Atleast One Search Field");

                        </script>
            <?php
        }
        if ($_GET["location"] != 10 && $_GET["cuisine"] == 10) {
            //  echo "100"; 

            $query = "select distinct * from business_info WHERE  business_info.business_city ='$location'";

            search($query);
        }
        if ($_GET["location"] == 10 && $_GET["cuisine"] != 10) {
            //echo "010";
            $query = "select distinct * from business_info WHERE FIND_IN_SET('$cuisine',business_info.restaurant_cuisine)";

            search($query);
        }

        if ($_GET["location"] != 10 && $_GET["cuisine"] != 10) {
            //echo "110";
            $query = "select distinct  * from business_info WHERE FIND_IN_SET('$cuisine',business_info.restaurant_cuisine) and business_info.business_city ='$location'";

            search($query);
        }
    }
}
?>
                        <footer>
                            
                        </footer>


        </div>
        
    </body>

</html>

<?php

ob_end_flush();
?>