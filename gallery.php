<?php
require 'header1.php';
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="SHORTCUT ICON" href="favicon.ico" type="image/x-icon" />

<meta name="description" content="Image gallery with description in 4 lines of jQuery code" />
<meta name="keywords" content="jquery tutorial,image gallery, jquery delegate" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<link rel="stylesheet" href="styles.css" type="text/css" />


<title>MealGaadi</title>
</head>
<body> 


<div id="page">
<!-- loction id retrived from url -->
<h1></h1>
<?php 
$location=$_GET['loc_id'];
?>
<!-- large image path format is = large"locationid"("image number").jpg ..... similarly for thumbnails  thumb"locationid"("imagenumber").jpg -->
<div id="gallery">
	<div id="panel">
		<img id="largeImage" src="locations/large<?php echo  $location ?>(1).jpg" />
		<!--<div id="description">1st image description</div>-->
	</div>
<!-- value of i can be incresed if more than 10 images needed...if image not found..that image tag's display=none -->
	<div id="thumbs">
            
            
            <?php 
            $i=1;
            while( $i !=10) { 
                 ?>
            
            <img id="thumbsImage" src="locations/thumb<?php echo  $location."(".$i.")" ?>.jpg" onerror='this.style.display = "none"' alt="1st image description" />
          
    <?php 
              $i++;
            }
                 ?>



                
            
            
            
        
</div>

</div>

<script>

$('#thumbs').delegate('img','click', function(){
	$('#largeImage').attr('src',$(this).attr('src').replace('thumb','large'));
	//$('#description').html($(this).attr('alt'));
});

</script>


</body>
</html>