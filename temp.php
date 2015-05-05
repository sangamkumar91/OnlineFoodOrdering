<?php ob_start(); ?>
<html>
    <body>


<?php

session_start();
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
    }}
if(isset($_SESSION['loc_id']))
{
    unset($_SESSION['loc_id']);
}

?>

<?php
function connect() {
    $con = mysql_connect("localhost", "root", "");
    mysql_select_db("futurecaptcha");
}
?>

<div id="bg">

<?php
require 'header1.php';
?>
<div id="gradcontainer">    
    <div class="title1"><br>FIND FOOD NOW!</div>
    <div id="search">
        <form action="index.php" method="POST">
            <div id="searchform">
                <table>
                    
                    <tr>  
                        <td><select name= "location" class="dropdown"></option>
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
                        <td><select name= "cuisine" class="dropdown" >
                                    <option value="10">CUISINE</option>
                                    <option value="chinese">CHINESE</option>
                                    <option value="north indian">NORTH INDIAN</option>
                                </select></td>
                            <td><input id="search_text1" type= "text" placeholder="ENTER DISH" name="dish"></td>
                            <td  ><input id="search_button" type= "submit" value = "" name="search"></td>

                    </tr>
                    <tr align ="center" >
                            <td><label class="instru">SELECT YOUR LOCATION</label></td>
                            <td><label class="instru">SELECT CUISINE TYPE</label></td>
                            <td><label class="instru">ENTER DESIRED DISH</label></td>
                    </tr>
					 <tr align ="center" >
                        <td><input name="homedelivery"  type="checkbox"  value="1">Home Delivery</td>
                        <td><input name="takeaway"  type="checkbox"  value="1">Take Away</td>
                        <td><input name="dinein"  type="checkbox"  value="1">Dine In</td>
                    </tr>
                   
                </table>

            </div>
        </form>
    </div>
</div>
      
<footer>
             <div id="footer_text"> <br> 
			Designed by kumar sangam
		      </div>
                 </footer>
				 
				 </div>
				 


</body>
</html>
<?php

ob_end_flush();
?>