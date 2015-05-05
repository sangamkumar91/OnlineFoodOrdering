<?php
session_start();
require 'func.php';
include 'header1.php';
if(!isset($_SESSION['loc_id']))
{
    $loc_id = $_GET['loc_id'];
    $loc_id = mysql_real_escape_string($loc_id);
    $_SESSION['loc_id'] = $loc_id;
}

connect();
require'rest.php';
$service_row = $info_row;
?>

<html>
<body>


<ul class="inforest">
  <li>Address: <?php echo $info_row['business_building'].', '.$info_row['business_street'].', '.$info_row['business_city']; ?></li><br />
  
  <li>Cuisines: <?php echo $service_row['restaurant_cuisine'];?></li><br />
  <li>Type: <?php echo $service_row['restaurant_type'];?></li><br />
  <li>Timings: <?php echo $service_row['restaurant_timings'];?></li><br />
  
  <li>Minimum Delivery: <?php echo $service_row['minimum_delivery_cost'].' Rs.';?></li><br />
  <li>Delivery Charges: <?php echo $service_row['delivery_charges'];?></li><br />
  <li>Cost for 2: <?php echo $service_row['cost_for_two'].' Rs.';?></li><br />
  </ul>
  <div id="infopic">
  <ul class="infopic">
  <li> 
  <?php if ($service_row['dine_in'] == 1) {
                    ?><image src="images\dinein.jpg" title="Dine In" ><?php
                } else {
                                ?> <image src="images\dinein_no.jpg" title="No Dine In" ><?php }
                            ?></li> 
  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<li> 
  <?php if ($service_row['air_conditioned'] == 1) {
                    ?><image src="images\AC.jpg" title="Air Conditioned" ><?php
                } else {
                                ?> <image src="images\AC_NO.jpg" title="No Air Conditioning" ><?php }
                            ?></li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  <br><li><?php if ($service_row['catering'] == 1) {
                    ?><image src="images\catering.jpg" title="Catering" ><?php
                } else {
                                ?><image src="images\catering_no.jpg" title="No Catering" ><?php }
                            ?></li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  <li><?php if ($service_row['alcohol_facility'] == 1) {
                    ?><image src="images\alcohol.jpg" title="Alcohol" > <?php
                } else {
                                ?> <image src="images\alcohol_no.jpg" title="No Alcohol" > <?php }
                            ?></li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  <br><li><?php if ($service_row['restaurant_type'] == "veg") {
                    ?><image src="images\veg.jpg" title="Veg" ><?php
                } else {
                            echo "     ";    ?> <image src="images\non_veg.jpg" title="Non Veg" ><?php }
                            ?></li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  
  
  
  <li><?php if ($service_row['home_delivery'] == 1) {
                    ?><image src="images\home_delivery.jpg" title="Home Delivery" ><?php
                } else {
                                ?> <image src="images\home_delivery_no.jpg" title="No Home Delivery" ><?php }
                            ?></li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  
  <br><li><?php if ($service_row['credit_card'] == 1) {
                    ?><image src="images\credit_card.jpg" title="Credit Card" ><?php
                } else {
                                ?> <image src="images\credit_card_no.jpg" title="No Credit Card" ><?php }
                            ?></li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  <li><?php if ($service_row['take_away'] == 1) {
                    ?><image src="images\take_away.jpg" title="Takeaway" ><?php
                } else {
                                ?> <image src="images\take_away_no.jpg" title="No takeaway" ><?php }
                            ?></li>
  
</ul>
</div>
</body>
</html>
<html>
<body>

<footer>
                          <div id="footer_text"> <br> 
						Designed by kumar sangam
		      		</div>
                        </footer>
</body>
</html>