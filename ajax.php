<!-- IMPORTANT:::  Always edit the data length conditions in javascript.js  as soon as up update  ajax.php with a single line or character or comment or code or anything...    -->
<!--
Basic search and filter properties properties.


1) Atleast one of cuisine , location or dish is needed to initiate search.
2) Results are ordered in such a way that restaurants with most variety of cuisines will be displayed first....
3) "AND" gates  between conditions everywhere except the following:
      a) current time results OR open between time results
      b) cuisine1 results OR cuisine2 results...
      c) homedelivery results OR takeaway results or dine in results
      d) Maximum 3 results displayed in one iteration...click more button retrieves more 3 results without reloadingg the page..no. of results can be edited by changing value of "nop" in  javascript.js and header1.php  
-->

<?php
session_start();


mysql_connect('localhost', 'root', '') or die();
mysql_select_db('futurecaptcha');


// all values posted by javascript .js are stored in variables


$offset = is_numeric($_POST['offset']) ? $_POST['offset'] : die();
$postnumbers = is_numeric($_POST['number']) ? $_POST['number'] : die();
$veg = $_POST['veg'] ;
$freedev = $_POST['freedev'] ;
$wifi = $_POST['wifi'] ;
$ac = $_POST['ac'] ;
$catering = $_POST['catering'] ;
$credit = $_POST['credit'] ;
$alcohol = $_POST['alcohol'] ;
$nonveg = $_POST['nonveg'] ;
$opentime =$_POST['opentime'];
$closetime =$_POST['closetime'];
$timings =$_POST['currenttime'];

$cf2min = $_POST['cf2min'] ;
$cf2max = $_POST['cf2max'] ;

//$nonveg = $_POST['nonveg'] ;

?>
<!-- this function is to anchor the screen to search results as soon as the search is clicked so that user does not need to scroll down...searchform anchored here -->
<?php

function anchor() {
    ?>
    <script>
        $(function() {
            $(document).scrollTop($("#searchform").offset().top);
        });
        //$('body,html').animate({ scrollTop: $('body').height() }, 800);
    </script>            
    <?php
}
?>
    <!-- cookie from index.php exploded and saved in variables from pieces..... first piece has the cuisine string which is exploded in the cuisine array -->
<?php
if (isset($_COOKIE["acookie"])) {
    $pieces = explode(",", $_COOKIE["acookie"]);
    $cuisine = explode(";", $pieces[0]);
    $dish = $pieces[1];
    $location = $pieces[2];
    $search = $pieces[3];
    $homedelivery = $pieces[4];
    $takeaway = $pieces[5];
    $dinein = $pieces[6];
    if(!$opentime)
    {
        
$opentime = $pieces[16];
$closetime = $pieces[17];

$cf2min = $pieces[18];
$cf2max = $pieces[19];
    }
    //$veg = $pieces[7];
    //$ac = $pieces[8];
    //$alcohol = $pieces[9];
    //$timings = $pieces[10];
    //$credit = $pieces[11];
    //$freedev = $pieces[12];
    //$cf2 = $pieces[13];
    //$wifi = $pieces[14];
    //$catering = $pieces[15];
   // echo $offset;
    
}

// queries of each and every combination of the fields in the searchform entered or not entered 
//sqlquery funtion called to concatenate query string with filter conditions
//while loop run in some queries to concatenate cuisine conditions in them if multiple cuisines hav been entered
//queries have a limit set by postnumbers and offset.. helpful for scroll click purposes...read javascript.js=> scroll funtion=> variable settings
if (isset($search)) {


    if ($homedelivery || $dinein || $takeaway) {


        if ($dish) {


            if ($location == 10 && $cuisine[0] == "") {
                //echo "001";
                $query = "select distinct business_info.location_id,`website_id`,`thumbnail`, `business_name`, `business_building`, `business_street`, `business_city`, `business_state`, `business_zipcode`, `business_countrycode`, `business_contact`, `restaurant_type`, `maximum_delivery_km`, `minimum_delivery_cost`, `restaurant_cuisine`, `delivery_charges`, `alcohol_facility`, `dine_in`, `catering`, `credit_card`, `cost_for_two`, `air_conditioned`, `tax`, `take_away`, `home_delivery`, `open_time`, `close_time` from business_info,products WHERE (business_info.home_delivery='$homedelivery' or business_info.take_away='$takeaway' or business_info.dine_in='$dinein' ) and products.product_name like '%$dish%' and business_info.location_id = products.location_id ";
 
                $query = sqlquery($query,$veg,$nonveg,$ac,$alcohol,$timings,$opentime,$closetime,$credit,$freedev,$cf2,$wifi,$catering,$cf2min,$cf2max);
                $query= $query."ORDER BY  CHAR_LENGTH(restaurant_cuisine) DESC,(`home_delivery`+`take_away`+`dine_in`) DESC LIMIT " . $postnumbers . " OFFSET " . $offset ."";
              //  echo $query;
                search($query);
                if ($offset == 0) {
                    anchor();
                }
            }
            if ($location != 10 && $cuisine[0] == "") {
                //echo "101";
                $query = "select distinct business_info.location_id,`website_id`,`thumbnail`, `business_name`, `business_building`, `business_street`, `business_city`, `business_state`, `business_zipcode`, `business_countrycode`, `business_contact`, `restaurant_type`, `maximum_delivery_km`, `minimum_delivery_cost`, `restaurant_cuisine`, `delivery_charges`, `alcohol_facility`, `dine_in`, `catering`, `credit_card`, `cost_for_two`, `air_conditioned`, `tax`, `take_away`, `home_delivery`, `open_time`, `close_time` from business_info,products WHERE (business_info.home_delivery='$homedelivery' or business_info.take_away='$takeaway' or business_info.dine_in='$dinein' ) and  business_info.business_city ='$location'
                and products.product_name like '%$dish%' and business_info.location_id = products.location_id ";

 
                $query = sqlquery($query,$veg,$nonveg,$ac,$alcohol,$timings,$opentime,$closetime,$credit,$freedev,$cf2,$wifi,$catering,$cf2min,$cf2max);
                $query= $query."ORDER BY  CHAR_LENGTH(restaurant_cuisine) DESC,(`home_delivery`+`take_away`+`dine_in`) DESC LIMIT " . $postnumbers . " OFFSET " . $offset . "";
              echo $query;
                search($query);
                if ($offset == 0) {
                    anchor();
                }
            }
            if ($location == 10 && $cuisine[0] != "") {
                //echo "011";
                //$query = "select distinct business_info.location_id,`website_id`,`thumbnail`, `business_name`, `business_building`, `business_street`, `business_city`, `business_state`, `business_zipcode`, `business_countrycode`, `business_contact`, `restaurant_type`, `maximum_delivery_km`, `minimum_delivery_cost`, `restaurant_cuisine`, `delivery_charges`, `alcohol_facility`, `dine_in`, `catering`, `credit_card`, `cost_for_two`, `air_conditioned`, `tax`, `take_away`, `home_delivery` from business_info,products WHERE (business_info.home_delivery='$homedelivery' or business_info.take_away='$takeaway' or business_info.dine_in='$dinein' ) and (FIND_IN_SET('$cuisine',business_info.restaurant_cuisine) or  products.product_name like '%$dish%') and business_info.location_id = products.location_id ORDER BY  (`home_delivery`+`take_away`+`dine_in`) DESC LIMIT ".$postnumbers." OFFSET ".$offset."";

                $query = "select distinct business_info.location_id,`website_id`,`thumbnail`, `business_name`, `business_building`, `business_street`, `business_city`, `business_state`, `business_zipcode`, `business_countrycode`, `business_contact`, `restaurant_type`, `maximum_delivery_km`, `minimum_delivery_cost`, `restaurant_cuisine`, `delivery_charges`, `alcohol_facility`, `dine_in`, `catering`, `credit_card`, `cost_for_two`, `air_conditioned`, `tax`, `take_away`, `home_delivery`, `open_time`, `close_time` from business_info,products WHERE (business_info.home_delivery='$homedelivery' or business_info.take_away='$takeaway' or business_info.dine_in='$dinein' ) and ((";

                $j = 0;
                while (TRUE) {

                    $query = $query . "(FIND_IN_SET('$cuisine[$j]',business_info.restaurant_cuisine))";

                    if ($cuisine[++$j] == "") {
                        break;
                    } else {
                        $query = $query . " or ";
                    }
                }
                 $query= $query.")   and products.product_name like '%$dish%')";
 
                $query = sqlquery($query,$veg,$nonveg,$ac,$alcohol,$timings,$opentime,$closetime,$credit,$freedev,$cf2,$wifi,$catering,$cf2min,$cf2max);
                
                $query = $query . " and business_info.location_id = products.location_id ORDER BY  CHAR_LENGTH(restaurant_cuisine) DESC,(`home_delivery`+`take_away`+`dine_in`) DESC LIMIT " . $postnumbers . " OFFSET " . $offset . "";



                search($query);
                if ($offset == 0) {
                    anchor();
                }
            }

            if ($location != 10 && $cuisine[0] != "") {
//echo "111";
                // $query = "select distinct business_info.location_id,`website_id`,`thumbnail`, `business_name`, `business_building`, `business_street`, `business_city`, `business_state`, `business_zipcode`, `business_countrycode`, `business_contact`, `restaurant_type`,  `maximum_delivery_km`, `minimum_delivery_cost`, `restaurant_cuisine`, `delivery_charges`, `alcohol_facility`, `dine_in`, `catering`, `credit_card`, `cost_for_two`, `air_conditioned`, `tax`, `take_away`, `home_delivery` from business_info,products where (business_info.home_delivery='$homedelivery' or business_info.take_away='$takeaway' or business_info.dine_in='$dinein' ) and business_info.business_city ='$location' and (FIND_IN_SET('$cuisine',business_info.restaurant_cuisine)
                //   or products.product_name like '%$dish%') and business_info.location_id = products.location_id ORDER BY  (`home_delivery`+`take_away`+`dine_in`) DESC LIMIT ".$postnumbers." OFFSET ".$offset."";

                $query = "select distinct business_info.location_id,`website_id`,`thumbnail`, `business_name`, `business_building`, `business_street`, `business_city`, `business_state`, `business_zipcode`, `business_countrycode`, `business_contact`, `restaurant_type`,  `maximum_delivery_km`, `minimum_delivery_cost`, `restaurant_cuisine`, `delivery_charges`, `alcohol_facility`, `dine_in`, `catering`, `credit_card`, `cost_for_two`, `air_conditioned`, `tax`, `take_away`, `home_delivery`, `open_time`, `close_time` from business_info,products WHERE (business_info.home_delivery='$homedelivery' or business_info.take_away='$takeaway' or business_info.dine_in='$dinein' ) and  business_info.business_city ='$location' and ((";

                $j = 0;
                while (TRUE) {

                    $query = $query . "(FIND_IN_SET('$cuisine[$j]',business_info.restaurant_cuisine))";

                    if ($cuisine[++$j] == "") {
                        break;
                    } else {
                        $query = $query . " or ";
                    }
                }
                  $query= $query.")   and products.product_name like '%$dish%')";
 
                $query = sqlquery($query,$veg,$nonveg,$ac,$alcohol,$timings,$opentime,$closetime,$credit,$freedev,$cf2,$wifi,$catering,$cf2min,$cf2max);
                $query = $query . " and business_info.location_id = products.location_id ORDER BY  CHAR_LENGTH(restaurant_cuisine) DESC,(`home_delivery`+`take_away`+`dine_in`) DESC LIMIT " . $postnumbers . " OFFSET " . $offset . "";


                search($query);

                if ($offset == 0) {
                    anchor();
                }
            }
        }

        if (!$dish) {


            if ($location == 10 && $cuisine[0] == "") {
                ?>
                <script>
                    alert("Enter Atleast One Search Field");
                </script>
                <?php
            }
            if ($location != 10 && $cuisine[0] == "") {
                //  echo "100"; 

                $query = "select distinct * from business_info WHERE (business_info.home_delivery='$homedelivery' or business_info.take_away='$takeaway' or business_info.dine_in='$dinein' ) and  business_info.business_city ='$location' ";

 
                $query = sqlquery($query,$veg,$nonveg,$ac,$alcohol,$timings,$opentime,$closetime,$credit,$freedev,$cf2,$wifi,$catering,$cf2min,$cf2max);
                
                $query = $query . "  ORDER BY  CHAR_LENGTH(restaurant_cuisine) DESC,(`home_delivery`+`take_away`+`dine_in`) DESC LIMIT " . $postnumbers . " OFFSET " . $offset . " ";

  //              echo $query;
                search($query);
                if ($offset == 0) {
                    anchor();
                }
            }
            if ($location == 10 && $cuisine[0] != "") {
                //echo "010";

                $query = "select distinct * from business_info WHERE (business_info.home_delivery='$homedelivery' or business_info.take_away='$takeaway' or business_info.dine_in='$dinein' ) and (";

                $j = 0;
                while (TRUE) {

                    $query = $query . "(FIND_IN_SET('$cuisine[$j]',business_info.restaurant_cuisine))";

                    if ($cuisine[++$j] == "") {
                        break;
                    } else {
                        $query = $query . " or ";
                    }
                }
                $query= $query.")";
 
                $query = sqlquery($query,$veg,$nonveg,$ac,$alcohol,$timings,$opentime,$closetime,$credit,$freedev,$cf2,$wifi,$catering,$cf2min,$cf2max);
                
                $query = $query . "   ORDER BY  CHAR_LENGTH(restaurant_cuisine) DESC,(`home_delivery`+`take_away`+`dine_in`) DESC LIMIT " . $postnumbers . " OFFSET " . $offset . "";

                search($query);
                if ($offset == 0) {
                    anchor();
                }
            }

            if ($location != 10 && $cuisine[0] != "") {
                //echo "110";
                $query = "select distinct * from business_info WHERE (business_info.home_delivery='$homedelivery' or business_info.take_away='$takeaway' or business_info.dine_in='$dinein' ) and (";

                $j = 0;
                while (TRUE) {

                    $query = $query . "(FIND_IN_SET('$cuisine[$j]',business_info.restaurant_cuisine))";

                    if ($cuisine[++$j] == "") {
                        break;
                    } else {
                        $query = $query . " or ";
                    }
                }
                 $query= $query.")";
 
                $query = sqlquery($query,$veg,$nonveg,$ac,$alcohol,$timings,$opentime,$closetime,$credit,$freedev,$cf2,$wifi,$catering,$cf2min,$cf2max);
                
                $query = $query . "  and business_info.business_city ='$location' ORDER BY  CHAR_LENGTH(restaurant_cuisine) DESC,(`home_delivery`+`take_away`+`dine_in`) DESC LIMIT " . $postnumbers . " OFFSET " . $offset . " ";

                search($query);

                if ($offset == 0) {
                    anchor();
                }
            }
        }
    } else {

        if ($dish) {

            if ($location == 10 && $cuisine[0] == "") {
                //echo "001";
                $query = "select distinct business_info.location_id,`website_id`,`thumbnail`, `business_name`, `business_building`, `business_street`, `business_city`, `business_state`, `business_zipcode`, `business_countrycode`, `business_contact`, `restaurant_type`,  `maximum_delivery_km`, `minimum_delivery_cost`, `restaurant_cuisine`, `delivery_charges`, `alcohol_facility`, `dine_in`, `catering`, `credit_card`, `cost_for_two`, `air_conditioned`, `tax`, `take_away`, `home_delivery`, `open_time`, `close_time` from business_info,products WHERE  products.product_name like '%$dish%' and business_info.location_id = products.location_id ";
 
                $query = sqlquery($query,$veg,$nonveg,$ac,$alcohol,$timings,$opentime,$closetime,$credit,$freedev,$cf2,$wifi,$catering,$cf2min,$cf2max);
                $query= $query." ORDER BY  CHAR_LENGTH(restaurant_cuisine) DESC LIMIT " . $postnumbers . " OFFSET " . $offset . " ";
                
                
// echo $query;               
                search($query);
                if ($offset == 0) {
                    anchor();
                }
            }
            if ($location != 10 && $cuisine[0] == "") {
                //echo "101";
                $query = "select distinct business_info.location_id,`website_id`,`thumbnail`, `business_name`, `business_building`, `business_street`, `business_city`, `business_state`, `business_zipcode`, `business_countrycode`, `business_contact`, `restaurant_type`,  `maximum_delivery_km`, `minimum_delivery_cost`, `restaurant_cuisine`, `delivery_charges`, `alcohol_facility`, `dine_in`, `catering`, `credit_card`, `cost_for_two`, `air_conditioned`, `tax`, `take_away`, `home_delivery`, `open_time`, `close_time` from business_info,products WHERE  business_info.business_city ='$location'
                and products.product_name like '%$dish%' and business_info.location_id = products.location_id ";

 
                $query = sqlquery($query,$veg,$nonveg,$ac,$alcohol,$timings,$opentime,$closetime,$credit,$freedev,$cf2,$wifi,$catering,$cf2min,$cf2max);
                $query= $query." ORDER BY  CHAR_LENGTH(restaurant_cuisine) DESC LIMIT " . $postnumbers . " OFFSET " . $offset . " ";
                
                search($query);
                if ($offset == 0) {
                    anchor();
                }
            }
            if ($location == 10 && $cuisine[0] != "") {
                //echo "011";
                // $query = "select distinct business_info.location_id,`website_id`,`thumbnail`, `business_name`, `business_building`, `business_street`, `business_city`, `business_state`, `business_zipcode`, `business_countrycode`, `business_contact`, `restaurant_type`, `maximum_delivery_km`, `minimum_delivery_cost`, `restaurant_cuisine`, `delivery_charges`, `alcohol_facility`, `dine_in`, `catering`, `credit_card`, `cost_for_two`, `air_conditioned`, `tax`, `take_away`, `home_delivery` from business_info,products WHERE  (FIND_IN_SET('$cuisine',business_info.restaurant_cuisine) or  products.product_name like '%$dish%') and business_info.location_id = products.location_id  LIMIT ".$postnumbers." OFFSET ".$offset."";

                $query = "select distinct business_info.location_id,`website_id`,`thumbnail`, `business_name`, `business_building`, `business_street`, `business_city`, `business_state`, `business_zipcode`, `business_countrycode`, `business_contact`, `restaurant_type`,  `maximum_delivery_km`, `minimum_delivery_cost`, `restaurant_cuisine`, `delivery_charges`, `alcohol_facility`, `dine_in`, `catering`, `credit_card`, `cost_for_two`, `air_conditioned`, `tax`, `take_away`, `home_delivery`, `open_time`, `close_time` from business_info,products WHERE  ((";

                $j = 0;
                while (TRUE) {

                    $query = $query . "(FIND_IN_SET('$cuisine[$j]',business_info.restaurant_cuisine))";

                    if ($cuisine[++$j] == "") {
                        break;
                    } else {
                        $query = $query . " or ";
                    }
                }
                $query= $query."  and  products.product_name like '%$dish%')";
 
                $query = sqlquery($query,$veg,$nonveg,$ac,$alcohol,$timings,$opentime,$closetime,$credit,$freedev,$cf2,$wifi,$catering,$cf2min,$cf2max);
                
                $query = $query . " and business_info.location_id = products.location_id ORDER BY  CHAR_LENGTH(restaurant_cuisine) DESC LIMIT " . $postnumbers . " OFFSET " . $offset . "";

                search($query);
                if ($offset == 0) {
                    anchor();
                }
            }

            if ($location != 10 && $cuisine[0] != "") {
//echo "111";
//            $query = "select distinct business_info.location_id,`website_id`,`thumbnail`, `business_name`, `business_building`, `business_street`, `business_city`, `business_state`, `business_zipcode`, `business_countrycode`, `business_contact`, `restaurant_type`,  `maximum_delivery_km`, `minimum_delivery_cost`, `restaurant_cuisine`, `delivery_charges`, `alcohol_facility`, `dine_in`, `catering`, `credit_card`, `cost_for_two`, `air_conditioned`, `tax`, `take_away`, `home_delivery` from business_info,products where  and business_info.business_city ='$location' and (FIND_IN_SET('$cuisine',business_info.restaurant_cuisine)
                //              or products.product_name like '%$dish%') and business_info.location_id = products.location_id  LIMIT ".$postnumbers." OFFSET ".$offset."";

                $query = "select distinct business_info.location_id,`website_id`,`thumbnail`, `business_name`, `business_building`, `business_street`, `business_city`, `business_state`, `business_zipcode`, `business_countrycode`, `business_contact`, `restaurant_type`,  `maximum_delivery_km`, `minimum_delivery_cost`, `restaurant_cuisine`, `delivery_charges`, `alcohol_facility`, `dine_in`, `catering`, `credit_card`, `cost_for_two`, `air_conditioned`, `tax`, `take_away`, `home_delivery`, `open_time`, `close_time` from business_info,products WHERE business_info.business_city ='$location' and  ((";

                $j = 0;
                while (TRUE) {

                    $query = $query . "(FIND_IN_SET('$cuisine[$j]',business_info.restaurant_cuisine))";

                    if ($cuisine[++$j] == "") {
                        break;
                    } else {
                        $query = $query . " or ";
                    }
                }
                $query= $query.") and products.product_name like '%$dish%')";
 
                $query = sqlquery($query,$veg,$nonveg,$ac,$alcohol,$timings,$opentime,$closetime,$credit,$freedev,$cf2,$wifi,$catering,$cf2min,$cf2max);
                
                $query = $query . "    and business_info.location_id = products.location_id ORDER BY  CHAR_LENGTH(restaurant_cuisine) DESC  LIMIT " . $postnumbers . " OFFSET " . $offset . "";


                search($query);
                if ($offset == 0) {
                    anchor();
                }
            }
        }

        if (!$dish) {


            if ($location == 10 && $cuisine[0] == "") {
                ?>
                <script>
                    alert("Enter Atleast One Search Field");
                </script>
                <?php
            }
            if ($location != 10 && $cuisine[0] == "") {


                //  echo "100"; 

                $query = "select distinct * from business_info WHERE  business_info.business_city ='$location' ";

 
                $query = sqlquery($query,$veg,$nonveg,$ac,$alcohol,$timings,$opentime,$closetime,$credit,$freedev,$cf2,$wifi,$catering,$cf2min,$cf2max);
                $query= $query." ORDER BY CHAR_LENGTH(restaurant_cuisine) DESC  LIMIT " . $postnumbers . " OFFSET " . $offset . " ";
               
                                
                               // echo $query;
                                
                                search($query);
                // echo $offset;
                if ($offset == 0) {
                    anchor();
                }
            }
            if ($location == 10 && $cuisine[0] != "") {
                //echo "010";
                //$query = "select distinct * from business_info WHERE  FIND_IN_SET('$cuisine',business_info.restaurant_cuisine) LIMIT ".$postnumbers." OFFSET ".$offset." ";


                $query = "select distinct * from business_info WHERE  (";

                $j = 0;
                while (TRUE) {

                    $query = $query . "(FIND_IN_SET('$cuisine[$j]',business_info.restaurant_cuisine))";

                    if ($cuisine[++$j] == "") {
                        break;
                    } else {
                        $query = $query . " or ";
                    }
                }
                $query= $query.")";
 
                $query = sqlquery($query,$veg,$nonveg,$ac,$alcohol,$timings,$opentime,$closetime,$credit,$freedev,$cf2,$wifi,$catering,$cf2min,$cf2max);
                
 $query = $query . " ORDER BY  CHAR_LENGTH(restaurant_cuisine) DESC  LIMIT " . $postnumbers . " OFFSET " . $offset . "";

                search($query);
                if ($offset == 0) {
                    anchor();
                }
            }

            if ($location != 10 && $cuisine[0] != "") {
                //echo "110";
                //  $query = "select distinct  * from business_info WHERE  FIND_IN_SET('$cuisine',business_info.restaurant_cuisine) and business_info.business_city ='$location'  LIMIT ".$postnumbers." OFFSET ".$offset." " ;


                $query = "select distinct * from business_info WHERE  (";

                $j = 0;
                while (TRUE) {

                    $query = $query . "(FIND_IN_SET('$cuisine[$j]',business_info.restaurant_cuisine))";

                    if ($cuisine[++$j] == "") {
                        break;
                    } else {
                        $query = $query . " or ";
                    }
                }
                $query= $query.")";
                $query = sqlquery($query,$veg,$nonveg,$ac,$alcohol,$timings,$opentime,$closetime,$credit,$freedev,$cf2,$wifi,$catering,$cf2min,$cf2max);
                
                $query = $query . "and business_info.business_city ='$location' ORDER BY  CHAR_LENGTH(restaurant_cuisine) DESC  LIMIT " . $postnumbers . " OFFSET " . $offset . " ";

                search($query);
                if ($offset == 0) {
                    anchor();
                }
            }
        }
    }
}
?>
<!-- filter conditions added in query with the help of sqlquery function -->
<div>   <?php

    function sqlquery ($query2,$veg2,$nonveg2,$ac2,$alcohol2,$timings2,$opentime2,$closetime2,$credit2,$freedev2,$cf22,$wifi2,$catering2,$cf2min2,$cf2max2)
                {
        if($cf2min2 || $cf2max2)
        $query2= $query2." and  cost_for_two >= '$cf2min2' and cost_for_two <='$cf2max2'  ";
        
        if($timings2 && !$opentime2)
        $query2 = $query2." and CAST('$timings2' AS TIME) BETWEEN open_time AND close_time ";
        
        if($opentime2 && !$timings2)
       
        $query2 = $query2." and ((open_time between '$opentime2' and '$closetime2') or (close_time between '$opentime2' and '$closetime2') or ((open_time >= '$opentime2' and close_time >= '$opentime2') and (open_time <= '$closetime2' and close_time <= '$closetime2')) or ((open_time <= '$opentime2' and close_time >= '$opentime2') and (open_time <= '$closetime2' and close_time >= '$closetime2')) )  ";
        
        if($timings2 && $opentime2)
        $query2 = $query2."and CAST('$timings2' AS TIME) BETWEEN open_time AND close_time or ((open_time between '$opentime2' and '$closetime2') or (close_time between '$opentime2' and '$closetime2') or ((open_time >= '$opentime2' and close_time >= '$opentime2') and (open_time <= '$closetime2' and close_time <= '$closetime2')) or ((open_time <= '$opentime2' and close_time >= '$opentime2') and (open_time <= '$closetime2' and close_time >= '$closetime2')) ) ";
                
   
        if($veg2){
            
            $query2 = $query2."and restaurant_type ='veg'";
            
        }
        if($nonveg2){
            
            $query2 = $query2."and restaurant_type !='veg'";
            
        }
        if($ac2){
            
            $query2 = $query2."and air_conditioned='1'";
            
        }
        if($alcohol2){
            
            $query2 = $query2."and alcohol_facility='1'";
            
        }
        //if($timings2!=0){
            
          //  $query2 = $query2."and restaurant_type ='veg'";
            
        //}
        if($credit2){
            
            $query2 = $query2."and credit_card ='1'";
            
        }
        if($freedev2){
            
            $query2 = $query2."and delivery_charges ='0'";
            
        }
        //if($cf22){
            
         //   $query2 = $query2."and delivery_charges ='0'";
            
        //}
        if($wifi2){
            
            $query2 = $query2."and wifi ='1'";
            
        }
        if($catering2){
            
            $query2 = $query2."and catering ='1'";
            
        }
        
        return $query2;
    }


//the place where constructed query is executed
    
    
    function search($query2) {
        

        mysql_connect("localhost", "root", "");
        mysql_select_db("futurecaptcha");
        $result2 = mysql_query($query2) or die(mysql_error());

        $num_rows = mysql_num_rows($result2);
        if ($num_rows != 0) {
            //$i = 1;
            while ($row = mysql_fetch_array($result2)) {
                ?>
                <h1><br></h1>
                <div id="searchresult" >
<!-- each table contsructed -->
                    <table id="searchresulttable" >
                        <tr>
                            <td rowspan="6"><?php //echo  ?></td>
                            <td colspan="3" id="bigname">
                                <?php
                                //website row in table websites corresponding to  the given location traced in rowtemp
                    $website = $row['website_id'];
                    $temp = "select distinct website_domain from websites where website_id= '$website'";
                    $resulttemp = mysql_query($temp);
                    while ($rowtemp = mysql_fetch_array($resulttemp)) {
                        ?> <a href="info.php?loc_id=<?php echo $row['location_id'] ?>"><?php echo $row['business_name']; ?></a></td>

                            <td rowspan="6" ><a href="gallery.php?loc_id=<?php echo $row['location_id'] ?> "> <image id="thumbnail" src="<?php echo $row['thumbnail'] ?>"  title="thumbnail" ></a></td>
                            <td colspan="4"  >Timings:
 <?php 
 
 // close time and open time of restaurant converted from 24 hour format to 12 hour format
 
 $time = explode(":", $row['open_time']);
                            
 if($time[0]+12 >24){
     $time[0] = $time[0] -12;
     if($time[0]<10)
     {
     $time2 = implode(":",$time );
     
     $time3 = "0".substr($time2, 0, 5)." PM  to  " ;
     }
     else{
         $time2 = implode(":",$time );
     
     $time3 = substr($time2, 0, 5)." PM  to  " ;
     }
     
     }
 else 
     $time3 = substr($row['open_time'], 0, 5)." AM  to  " ;
 
 $time = explode(":", $row['close_time']);
                            
 if($time[0]+12 >24){
    $time[0] = $time[0] -12;
     if($time[0]<10)
     {
     $time2 = implode(":",$time );
     
     $time3 = $time3."0".substr($time2, 0, 5)." PM  to  " ;
     }
     else{
         $time2 = implode(":",$time );
     
     $time3 = $time3.substr($time2, 0, 5)." PM  to  " ;
     }   
     }
 else 
     $time3 =$time3.substr($row['close_time'], 0, 5)." AM  " ;
 
 echo $time3;
 
 ?></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                
                    <a href="info.php?loc_id=<?php echo $row['location_id'] ?>"><?php echo $rowtemp['website_domain']; ?></a>  <?php
                    }
                    ?>
                            </td>
                            <td colspan="4">Cost for Two: <?php echo $row['cost_for_two']; ?></td>
                        </tr>
                        
                                                <?php
                                                
  // this part is to display the facilities present in restaurant and absent in restaurant together as tehy are diplayed....here the facilties image path are stored in an array.. in orderd form...and are transferred to src attribite of the image tag                                               
                                                
$iconspresent = array();
$iconsabsent = array();
$titlepresent = array();
$titleabsent = array();
$p = 0;
$a = 0;


if ($row['credit_card'] == 1) {

    $iconspresent[$p] = "images\credit_card.jpg";
    $titlepresent[$p] = "credit_card";
    $p++;
} else {
    $iconsabsent[$a] = "images\credit_card_no.jpg";
    $titleabsent[$a] = "No credit card";
    $a++;
}
if ($row['alcohol_facility'] == 1) {

    $iconspresent[$p] = "images\alcohol.jpg";
    $titlepresent[$p] = "Alcohol";
    $p++;
} else {
    $iconsabsent[$a] = "images\alcohol_no.jpg";
    $titleabsent[$a]= "No Alcohol";
    $a++;
}

if ($row['dine_in'] == 1) {

    $iconspresent[$p] = "images\dinein.jpg";
    $titlepresent[$p] = "Dine in";
    $p++;
} else {
    $iconsabsent[$a] = "images\dinein_no.jpg";
    $titleabsent[$a] = "No Dine In";
    $a++;
}
if ($row['take_away'] == 1) {

    $iconspresent[$p] = "images/take_away.jpg";
    $titlepresent[$p] = "Take Away";
    $p++;
} else {
    $iconsabsent[$a] = "images/take_away_no.jpg";
    $titleabsent[$a] = "No Take Away";
    $a++;
}
if ($row['catering'] == 1) {

    $iconspresent[$p] = "images\catering.jpg";
    $titlepresent[$p] = "Catering";
    $p++;
} else {
    $iconsabsent[$a] = "images\catering_no.jpg";
    $titleabsent[$a] = "No Catering";
    $a++;
}
if ($row['home_delivery'] == 1) {

    $iconspresent[$p] = "images\home_delivery.jpg";
    $titlepresent[$p] = "Home Delivery";
    $p++;
} else {
    $iconsabsent[$a] = "images\home_delivery_no.jpg";
    $titleabsent[$a] = "No Home delivery";
    $a++;
}
if ($row['air_conditioned'] == 1) {

    $iconspresent[$p] = "images\AC.jpg";
    $titlepresent[$p] = "AC";
    $p++;
} else {
    $iconsabsent[$a] = "images\AC_NO.jpg";
    $titleabsent[$a] = "No AC";
    $a++;
}
$t=0;
$icons= array ();
$title= array();
$p--;
while($p>=0)
{
    
    $icons[$t] = $iconspresent[$p];
    $title[$t] = $titlepresent[$p];
    $p--;
    $t++;
    
}
$a--;
while($a>=0)
{
    
    $icons[$t] = $iconsabsent[$a];
    $title[$t] = $titleabsent[$a];
    $a--;
    $t++;
    
}


?>
                        

                        <tr>
                            <td colspan="3"><?php echo $row['business_building'], $row['business_city']; ?><br><?php echo "Contact No:" . $row['business_contact']; ?></td>
                            <td rowspan="2"><image src="<?php echo $icons[6]; ?>"  title="<?php echo $title[6]; ?>" ></td>
                            <td rowspan="2"><image src="<?php echo $icons[5]; ?>"  title="<?php echo $title[5]; ?>" ></td>
                            <td rowspan="2"><image src="<?php echo $icons[4]; ?>"  title="<?php echo $title[4]; ?>" ></td>
                            <td rowspan="2"><image src="<?php echo $icons[3]; ?>"  title="<?php echo $title[3]; ?>" ></td>
                        </tr>
                        <tr>
                            <td colspan="3"><?php echo $row['restaurant_cuisine']; ?></td>
                        </tr>
                        <tr>
                            <td rowspan="2"><a href="menu.php?loc_id=<?php echo $row['location_id'] ?> " ><image src="images\order.jpg" title="order" ></a></td>
                            <td rowspan="2"><a href="menu.php?loc_id=<?php echo $row['location_id'] ?> " ><image src="images\menu.jpg"  title="menu" ></a></td>
                            <td rowspan="2"><a href="map.php?loc_id=<?php echo $row['location_id'] ?> " ><image src="images\navigation.jpg"  title="Navigation" ></a></td>
                            <td rowspan="2"><image src="<?php echo $icons[2]; ?>"  title="<?php echo $title[2]; ?>" ></td>
                            <td rowspan="2"><image src="<?php echo $icons[1]; ?>"  title="<?php echo $title[1]; ?>" ></td>
                            <td rowspan="2"><image src="<?php echo $icons[0]; ?>"  title="<?php echo $title[0]; ?>" ></td>
                            <td rowspan="2">
                                            <?php
                                            if ($row['restaurant_type'] == "veg") {
                                                ?>
                                                <image src="images/veg.jpg"  title="Veg" >
                                                <?php
                                            } else {
                                                ?>
                                                <image src="images/non_veg.jpg"  title="Non Veg" >

                <?php
            }
            ?>

                                        </td>
                            
                        </tr>



                    </table>
            <?php ?>


                </div>



                <?php
                //$i++;
            }
        }
        
        
        
    }
    ?>    
</div>
<?php

?>