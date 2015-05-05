<?php



//$loc_id = filter_input(INPUT_POST,'loc_id',FILTER_SANITIZE_STRING);
$loc_id = $_SESSION['loc_id'];
//connect();

$result1 = mysql_query("SELECT * FROM `business_info` WHERE location_id = '$loc_id'");
if(mysql_num_rows($result1)==1)
{
    $info_row = mysql_fetch_array($result1);
    
}
else
{
    echo 'Location ID not valid';
    die();
}

?>
<html>
<body>
<link rel='stylesheet' href='css/style.css'>
<nav>
		<ul>
			<li><a href="info.php">Info</a></li>
			<li><a href="menu.php">Menu</a></li>
			<li><a href="map.php">Map</a></li>
			<li><a href="gallery.php?loc_id=<?php echo $loc_id;?>">Photos</a></li>
		</ul>
</nav>
<h2><?php echo strtoupper($info_row['business_name']); ?></h2>
<h4>Ph No. <?php echo $info_row['business_countrycose'].' - '.$info_row['business_contact'];?></h4>

</body>
</html>