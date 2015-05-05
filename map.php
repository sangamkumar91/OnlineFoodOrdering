<?php
ob_start();
session_start();
include 'header1.php';
require 'func.php';
if(isset($_GET['loc_id']))
{
    if(!isset($_SESSION['loc_id']))
    {
        $loc_id = $_GET['loc_id'];
        $loc_id = mysql_real_escape_string($loc_id);
        $_SESSION['loc_id'] = $loc_id;
    }
}
connect();
require 'rest.php';
?>

<!DOCTYPE html>
<html>
<head>
<script
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false">
</script>

<script>
var myCenter = new google.maps.LatLng(28.4897,77.0946);
function initialize()
{
var mapProp = {
  center:myCenter,
  zoom:18,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };
var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
map.setTilt(45);
var marker=new google.maps.Marker({
  position:myCenter,
  });

marker.setMap(map);

var infowindow = new google.maps.InfoWindow({
  content:"Future Captcha"
  });

google.maps.event.addListener(marker, 'click', function() {
  infowindow.open(map,marker);
  });
}



google.maps.event.addDomListener(window, 'load', initialize);
</script>
</head>

<body>
<div id="googleMap" style="left:270px;width:500px; height:380px;"></div>
<footer>
                          <div id="footer_text"> <br> 
						Designed by kumar sangam
		      		</div>
                        </footer>
</body>
</html>

<?php
ob_end_flush();
?>