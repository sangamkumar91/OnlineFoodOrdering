<!-- IMPORTANT:::  Always edit the data length conditions in javascript.js  as soon as up update  ajax.php with a single line or character or comment or code or anything...    -->

<?php ob_start(); ?>
<!DOCTYPE HTML>

<?php
// get values after submit button set in session variables  .
session_start();

$_SESSION['cuisine'] = $_GET['cuisine'];
$_SESSION['dish'] = $_GET['dish'];
$_SESSION['location'] = $_GET['location'];
$_SESSION['search'] = $_GET['search'];

$_SESSION['homedelivery'] = $_GET['homedelivery'];
$_SESSION['takeaway'] = $_GET['takeaway'];
$_SESSION['veg'] = $_GET['veg'];
$_SESSION['ac'] = $_GET['ac'];
$_SESSION['alcohol'] = $_GET['alcohol'];
//$_SESSION['timings'] = $_GET['timings'];
$_SESSION['credit'] = $_GET['credit'];
$_SESSION['freedev'] = $_GET['freedev'];
//$_SESSION['cf2'] = $_GET['cf2'];
$_SESSION['wifi'] = $_GET['wifi'];
$_SESSION['catering'] = $_GET['catering'];
$_SESSION['opentime'] =$_GET['opentime'];
$_SESSION['closetime'] =$_GET['closetime'];

$_SESSION['cf2min'] = $_GET['cf2min'] ;
$_SESSION['cf2max'] = $_GET['cf2max'] ;
// cookie set by session varaibles which will be sent to ajax.php.
setcookie("acookie",$_SESSION['cuisine'].",".$_SESSION['dish'].",".$_SESSION['location'].",".$_SESSION['search'].",".$_SESSION['homedelivery'].",".$_SESSION['takeaway'].",".$_SESSION['dinein'].",".$_SESSION['veg'].",".$_SESSION['ac'].",".$_SESSION['alcohol'].",".$_SESSION['timings'].",".$_SESSION['credit'].",".$_SESSION['freedev'].",".$_SESSION['cf2'].",".$_SESSION['wifi'].",".$_SESSION['catering'].",".$_SESSION['opentime'].",".$_SESSION['closetime'].",".$_SESSION['cf2min'].",".$_SESSION['cf2max'],time()+3600*24);
//code for checking whther user has logged in or not..
if($_SESSION['log']==false)
{
    if(isset($_SESSION['msg_temp']))
    {
        $msg_temp = $_SESSION['msg_temp'];
    }
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
 ;   
   /* if(isset($_SESSION['sign']))
    {
        echo $_SESSION['sign'];
    }*/
}
else
{
    ;}
if(isset($_SESSION['loc_id']))
{
    unset($_SESSION['loc_id']);
}

?>

<?php
//function connect defined to connect to mysql localhost
function connect() {
    $con = mysql_connect("localhost", "root", "");
    mysql_select_db("futurecaptcha");
}
?>

<html>

<body>

    
<div id="bg">
<!-- header required to  add all header.php contents on this itself  -->
<?php
require 'header1.php';
?>
<!-- this div is a pop up which is hidden till the dpopup field is clicked ...currently the cuisine text field...this calls popup.js functions   -->
     
    <div id="cuisinepopup" class="myPopup">
		
		<h1>Choose the Cuisine</h1>
    
                <input id="a1" type="checkbox" name="a1" value="north indian" onclick="adc()">North Indian<br>
                <input id="a2" type="checkbox" name="a2" value="chinese" onclick="adc()">Chinese<br>
                <input id="a3" type="checkbox" name="a3" value="south indian" onclick="adc()">South Indian<br>
                <input id="a4" type="checkbox" name="a4" value="mexican" onclick="adc()">Mexican<br>
                <input id="a5" type="checkbox" name="a5" value="mughlai" onclick="adc()">Mughlai<br>
                <input id="a6" type="checkbox" name="a6" value="snacks" onclick="adc()">Snacks<br>
                <button id="popupClose">Confirm</button>
                <br />
		
		
	</div>
	<div id="bgcuisinepopup" class="backgroundPopup"></div>
     
        
<div id="gradcontainer">  
<?php
  if(isset($msg_temp))
  {
    echo $msg_temp;
  }  
  ?>  <div class="title1"><br>FIND FOOD NOW!</div>
    <div id="search">
        <!-- this form has main search fields as well as filter fields in it which are hidden on the homepage -->
        <form action="index.php" name="search_form" method="GET">
            
            <div id="searchform">
                <table>
                     
                    <tr>  
                        <!-- location cities automatically fetched in the location select field -->
                        <td><select name= "location" class="dropdown" >
                                <option id="location1" value="10" <?php if (isset($_GET['location']) && $_GET['location'] == 10)echo ' selected="selected"';?>>Location</option>
                                <?php
                                connect();
                                $query1 = "select distinct business_city from business_info";
                                $result = mysql_query($query1);

                                while ($row = mysql_fetch_array($result)) {
                                    ?>
<!-- "selected = selected" written in the option tag to retain values in the field after page reload  -->
                                <option value="<?php echo $row["business_city"]; ?>" <?php if (isset($_GET['location']) && $_GET['location'] == $row["business_city"])echo ' selected="selected"';?> ><?php echo $row["business_city"]; ?></option>

                                    <?php
                                    mysql_close();
                                }
                                ?>

                            </select></td>
                     <td> 
<!--cuisine pop up field calls popup.js and function adc() in header.php -->
                                <input type="text" id="dcuisinepopup" class="displaypopup" placeholder="CUISINE" name="cuisine" readonly onclick="popupcheck(this.name)">


                            </td>
                            <td><input id="search_text" type= "text" placeholder="DISH" name="dish"></td>
                            <td><input id="search_button" type= "submit" value = "" name="search"></td>

                    </tr>
                    <tr align ="center" >
                            <td><label class="instru">SELECT YOUR LOCATION</label></td>
                            <td><label class="instru">SELECT CUISINE TYPE</label></td>
                            <td><label class="instru">ENTER DESIRED DISH</label></td>
                    </tr>
                    <!-- checkboxes resulting in "or" results -->
					<tr align ="center" >
                        <td><input name="homedelivery"  type="checkbox"  value="1" <?php echo empty($_GET['homedelivery']) ? '' : ' checked="checked" '; ?> >Home Delivery</td>
                        <td><input name="takeaway"  type="checkbox"  value="1" <?php echo empty($_GET['takeaway']) ? '' : ' checked="checked" '; ?> >Take Away</td>
                        <td><input name="dinein"  type="checkbox"  value="1" <?php echo empty($_GET['dinein']) ? '' : ' checked="checked" '; ?> >Dine In</td>
                    </tr>
                   
                </table>
                </div>
                          <!-- slider -->
        
         <link rel="stylesheet" href="themes/base/jquery.ui.all.css">
	<!--<script src="jquery-1.6.2.js"></script>-->
	<script src="ui/jquery.ui.core.js"></script>
	<script src="ui/jquery.ui.widget.js"></script>
	<script src="ui/jquery.ui.mouse.js"></script>
	<script src="ui/jquery.ui.slider.js"></script>
	<link rel="stylesheet" href="demos/demos.css">
	<style>
	#demo-frame > div.demo { padding: 10px !important; }
        
	</style>
	<?php 
        // this if condition to retain values on the slider even after page reload
        if($_GET["cf2min"]||$_GET["cf2max"]|| $_GET["opentime"]||$_GET["closetime"])
        {
            ?>
        <!--script for cost for 2 slider  and textboxes showing its values-->
    <script>
  var x = <?php echo json_encode($_GET["cf2min"]);?>;
    var y = <?php echo json_encode($_GET["cf2max"]);?>;
	$(function() {
		$( "#slider-range-cf2" ).slider({
			range: true,
			min: 0,
			max: 4000,
			values: [ x, y ],
			slide: function( event, ui ) {
				$( "#cf2min" ).val( ui.values[ 0 ]); 
			$( "#cf2max" ).val( ui.values[ 1 ]);
                        

    }


		});
		$( "#cf2min" ).val( $( "#slider-range-cf2" ).slider( "values", 0 )); 
$( "#cf2max" ).val( $( "#slider-range-cf2" ).slider( "values", 1 ));		

	});
        
        //alert("11111");

	</script>
        <!--script for open between time slider and textboxes showing values in 12 hour clock and 24 hour clock hidden textboxes  -->
        <script>
            
  var x1 = <?php echo json_encode($_GET["opentime"]);?>;
    var y1 = <?php echo json_encode($_GET["closetime"]);?>;
    var ot = x1.split(":"); 
    var ct = y1.split(":");

    
    var vot = parseInt(ot[0]*60) + parseInt(ot[1]);
    var vct = parseInt(ct[0]*60) + parseInt(ct[1]);
   // alert(vot);
    
    


	$(function() {
		$( "#slider-range-time" ).slider({
			range: true,
			min: 0,
			max: 1439,
			values: [ vot, vct ],
			slide: function( event, ui ) {
                            val0 = ui.values[ 0 ];
			 val1 = ui.values[ 1 ],
					minutes0 = parseInt(val0 % 60, 10),
					hours0 = parseInt(val0 / 60 % 24, 10),
					minutes1 = parseInt(val1 % 60, 10),
					hours1 = parseInt(val1 / 60 % 24, 10);



 	startTime = getTime(hours0, minutes0);
        endTime = getTime(hours1, minutes1);
        

                        $("#opentime").val(startTime);
                        $("#closetime").val(endTime);
                        
				
                        
					
				startTime1 = getTime1(hours0, minutes0);
				endTime1 = getTime1(hours1, minutes1);
				$("#opentime1").val(startTime1);
                                $("#closetime1").val(endTime1);
				
                        

    }


		});
            
            
function getTime(hours, minutes) {
				
				if (hours.length == 1) {
                                    
					hours = "0" + hours;
				}
                            
				if (minutes.length == 1) {
                                    
					minutes = "0" + minutes;
				}
				return hours + ":" + minutes;
			}
                    

    function getTime1(hours, minutes) {
				var time = null;
				minutes = minutes + "";
				if (hours < 12) {
					time = "AM";
				}
				else {
					time = "PM";
				}
				if (hours == 0) {
					hours = 12;
				}
				if (hours > 12) {
					hours = hours - 12;
				}
				if (minutes.length == 1) {
					minutes = "0" + minutes;
				}
				return hours + ":" + minutes + " " + time;
			}
                    
                    val0 = $( "#slider-range-time" ).slider( "values", 0 );
					val1 = $( "#slider-range-time" ).slider( "values", 1 ),
					minutes0 = parseInt(val0 % 60, 10),
					hours0 = parseInt(val0 / 60 % 24, 10),
					minutes1 = parseInt(val1 % 60, 10),
					hours1 = parseInt(val1 / 60 % 24, 10);
				
                              
 
startTime = getTime(hours0, minutes0);
endTime = getTime(hours1, minutes1);
$("#opentime").val(startTime);
$("#closetime").val(endTime);
				
                        
					
				startTime1 = getTime1(hours0, minutes0);
				endTime1 = getTime1(hours1, minutes1);
				$("#opentime1").val(startTime1);
                                $("#closetime1").val(endTime1);
				
	

	});
        
        
    
        
        
    </script>
    <!-- values set in sliders without page reload....always the maximum values are set -->
        <?php
            
            
            
        }
        else{
        
        ?>
        <script>
            
	$(function() {
		$( "#slider-range-cf2" ).slider({
			range: true,
			min: 0,
			max: 4000,
			values: [ 0, 4000 ],
			slide: function( event, ui ) {
				$( "#cf2min" ).val( ui.values[ 0 ]); 
			$( "#cf2max" ).val( ui.values[ 1 ]);
                        

    }


		});
		$( "#cf2min" ).val( $( "#slider-range-cf2" ).slider( "values", 0 )); 
$( "#cf2max" ).val( $( "#slider-range-cf2" ).slider( "values", 1 ));		

	});
        
        
	</script>
        <script>
            
	$(function() {
		$( "#slider-range-time" ).slider({
			range: true,
			min: 0,
			max: 1439,
			values: [ 0, 1439 ],
			slide: function( event, ui ) {
                            val0 = ui.values[ 0 ];
			 val1 = ui.values[ 1 ],
					minutes0 = parseInt(val0 % 60, 10),
					hours0 = parseInt(val0 / 60 % 24, 10),
					minutes1 = parseInt(val1 % 60, 10),
					hours1 = parseInt(val1 / 60 % 24, 10);



 	startTime = getTime(hours0, minutes0);
        endTime = getTime(hours1, minutes1);
        

                        $("#opentime").val(startTime);
                        $("#closetime").val(endTime);
                        
				
                        
					
				startTime1 = getTime1(hours0, minutes0);
				endTime1 = getTime1(hours1, minutes1);
				$("#opentime1").val(startTime1);
                                $("#closetime1").val(endTime1);
				
                        

    }


		});
            
            
function getTime(hours, minutes) {
				
				if (hours.length == 1) {
                                    
					hours = "0" + hours;
				}
                            
				if (minutes.length == 1) {
                                    
					minutes = "0" + minutes;
				}
				return hours + ":" + minutes;
			}
                    

    function getTime1(hours, minutes) {
				var time = null;
				minutes = minutes + "";
				if (hours < 12) {
					time = "AM";
				}
				else {
					time = "PM";
				}
				if (hours == 0) {
					hours = 12;
				}
				if (hours > 12) {
					hours = hours - 12;
				}
				if (minutes.length == 1) {
					minutes = "0" + minutes;
				}
				return hours + ":" + minutes + " " + time;
			}
                    
                    val0 = $( "#slider-range-time" ).slider( "values", 0 );
					val1 = $( "#slider-range-time" ).slider( "values", 1 ),
					minutes0 = parseInt(val0 % 60, 10),
					hours0 = parseInt(val0 / 60 % 24, 10),
					minutes1 = parseInt(val1 % 60, 10),
					hours1 = parseInt(val1 / 60 % 24, 10);
				
                              
 
startTime = getTime(hours0, minutes0);
endTime = getTime(hours1, minutes1);
$("#opentime").val(startTime);
$("#closetime").val(endTime);
				
                        
					
				startTime1 = getTime1(hours0, minutes0);
				endTime1 = getTime1(hours1, minutes1);
				$("#opentime1").val(startTime1);
                                $("#closetime1").val(endTime1);
				
	

	});
        
        
	</script>
        
       
        
        
        
        <!-- slider --> 
    <?php 
        
        }
        ?>
                    
               
            
 <?php           
 //filterform displayed only if the submit button has been clicked
 if(isset($_GET["search"]))
 {   // if($_GET["cuisine"]||$_GET["dish"]||$_GET["location"]!=10){
?>
                
              <!-- checkboxes when clicked call the pass function in header.php...which redirects all the varaibles to javascript.js -->
            <div id="filterform" >
                <table>
                    <!-- clear filter button calls function clearfilter() in pageredirect.js which sets all filters to default -->
                    <!-- checked=checked part to retain checked values if page reloads  -->
                    <tr><td   onclick="clearfilter();" ><label  name="clearfilter" >Clear All filters</label></td><td></td></tr>
                    <tr><td><input type="checkbox" id="veg" name="veg" onclick="pass();" value="1" <?php echo empty($_GET['veg']) ? '' : ' checked="checked" '; ?>></td><td>VEG</td></tr>
                    <tr><td><input type="checkbox" id="nonveg" name="nonveg" onclick="pass();" value="1" <?php echo empty($_GET['nonveg']) ? '' : ' checked="checked" '; ?>></td><td>NON-VEG</td></tr>
                    
                    <tr><td><input type="checkbox" id="credit" name="credit" onclick="pass();" value="1"<?php echo empty($_GET['credit']) ? '' : ' checked="checked" '; ?>></td><td>Credit Card Payment</td></tr>
                    <tr><td><input type="checkbox" id="freedev" name="freedev" onclick="pass();" value="1" <?php echo empty($_GET['freedev']) ? '' : ' checked="checked" '; ?>></td><td>Free Delivery</td></tr>
          
                    <tr><td><input type="checkbox" id="alcohol" name="alcohol" onclick="pass();" value="1"<?php echo empty($_GET['alcohol']) ? '' : ' checked="checked" '; ?>></td><td>Alcohol Facility</td></tr>
                    <tr><td><input type="checkbox" id="catering" name="catering" onclick="pass();" value="1"<?php echo empty($_GET['catering']) ? '' : ' checked="checked" '; ?>></td><td>Catering</td></tr>
                    <tr><td><input type="checkbox" id="wifi" name="wifi" onclick="pass();" value="1"<?php echo empty($_GET['wifi']) ? '' : ' checked="checked" '; ?>></td><td>Wifi</td></tr>
                    <tr><td><input type="checkbox" id="ac" name="ac" onclick="pass();" value="1"<?php echo empty($_GET['ac']) ? '' : ' checked="checked" '; ?>></td><td>Air Conditioning</td></tr>

                  <tr><td><input type="checkbox" id="currenttime1" name="currenttime1" onclick="pass();" value="1"<?php echo empty($_GET['currenttime1']) ? '' : ' checked="checked" '; ?>></td><td>Current Time</td><td> <input type="text" id="time" name="time" readonly ></td></tr>
                
                    <tr><td><div id="slider-range-time" onclick="pass()"></td><td>Open From:</td><td><input type="text" id="opentime1" name="opentime1" style="border:0; color:#f6931f; font-weight:bold;" /></td><td> to:</td><td><input type="text" id="closetime1" name="closetime1" style="border:0; color:#f6931f; font-weight:bold;" /></td></tr>
                    <!-- the input fields are hidden but these are the values which are passed to ajax.php --> 
                    <input type="text" id="opentime" name="opentime" style="border:0; color:#f6931f; font-weight:bold;" hidden /><input type="text" id="closetime" name="closetime" style="border:0; color:#f6931f; font-weight:bold;" hidden />
              
                    
                    <tr><td>
<div id="slider-range-cf2" onclick="pass()"></div>
</td>
<td>
<label for="amount">Cost For Two: Rs.</label>    
</td>
<td>
    <input type="text" id="cf2min" name="cf2min" style="border:0; color:#f6931f; font-weight:bold;" />
</td>
<td> - Rs.
</td>

<td>
    <input type="text" id="cf2max" name="cf2max" style="border:0; color:#f6931f; font-weight:bold;" />
</td>
                                        
                    </tr>
                    
                </table>
       
    
                </div>
             <?php } //} ?>
        </form>
   
    
</div>
    
<?php
if(isset($_GET['search']))
{
?>
       <!-- script to retain values in dish textfield and cuisine text fields -->
    <script>
    
    var str = <?php echo json_encode($_GET["cuisine"]);?>;
    
     document.getElementById("dcuisinepopup").value = str;
     
    str = <?php echo json_encode($_GET["dish"]);?>;
    
    document.getElementById("search_text").value = str;
</script>
<!-- to retain checked status in the cuisine popup checkboxes -->
<?php
$popup = explode(";",$_GET["cuisine"]);


$j = 0;
//string in cuisine field exploded and array values compared to each checkbox in the popup with the help of their ids

while($popup[$j]!=""){
    
    ?>
    <script>
    
    var type= <?php echo json_encode( $popup[$j]);?>;
        var i = 1;
        
    while(true)
    {var str = "a";
    str=str.concat(i);
    var check = document.getElementById(str).value;
    
    
     if( check == type  )
    document.getElementById(str).checked = "checked";
    
    i++;
    }   
        
    </script>
    <?php
    
    $j++;
    
}
 
?>        
<!-- content div is where the data from ajax.php is displayed with the help of scroll function javascript.js which is present in pass() and document.ready() 
 funtions in header.php-->
    
<div id="content">
	
	

</div>
<?php
}
?>
</div>
  <a href="admin.php" target="_blank">Admin Page</a>
  
      
<footer>
             <div id="footer_text"> <br> 
			Designed by kumar sangam
		      </div>
                 </footer>
				  </div>
        <!-- script sets up current time in the current time textfield in filterform  -->
                                  <script>
 


                                      var today=new Date();
var h=today.getHours();
var m=today.getMinutes();
var s=today.getSeconds();
// add a zero in front of numbers<10
m=checkTime(m);
h=checkTime(h);

document.getElementById('time').value=h+":"+m;


function checkTime(i)
{
if (i<10)
  {
  i="0" + i;
  }
return i;
}

     
                           </script>
	


</body>
</html>
<?php ob_end_flush(); ?>

