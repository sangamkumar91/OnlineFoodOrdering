<?php 
ob_start();
session_start(); 
?>

<!DOCTYPE html>
<html lang="en" class="nojs">
    <head >
    
    <link rel="SHORTCUT ICON" href="favicon.ico" type="image/x-icon" />


<script>
    var searchrequest = 0;
    </script>

<meta name="description" content="Image gallery with description in 4 lines of jQuery code" />
<meta name="keywords" content="jquery tutorial,image gallery, jquery delegate" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="jquery2.js"></script>
<link rel="stylesheet" href="stylespopup.css" type="text/css" />


<title>MealGaadi</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="jquery.min.js"></script>

<!--<script type="text/javascript" src="jquery.min.js"></script> -->
<script type="text/javascript" src="parsley.min.js"></script>
      

        <link rel = "stylesheet" href = "styles.css">
        <link rel = "stylesheet" href = "style.css">
        <title></title>
		
		<script src="jquery-1.6.2.js"> </script>
<script src="javascript.js"> </script>

<script type="text/javascript" src="vue1oix.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

<style type="text/css">

</style>

<!-- this script called when filters are clicked -->
<script>
     
function pass(){
   searchrequest = 1; 
  // alert ("click");
$('#content').empty();

$('#content').scroll({
          notfound: 'No Results Found',

		nop     : 3, // The number of posts per scroll to be loaded
		offset  : 0, // Initial offset, begins at 0 in this case
		error   : 'No More Posts!', // When the user reaches the end this is the message that is
		                            // displayed. You can change this if you want.
		delay   : 500, // When you scroll down the posts will load after a delayed amount of time.
		               // This is mainly for usability concerns. You can alter this as you see fit
		scroll  : false // The main bit, if set to false posts will not load as the user scrolls. 
		               // but will still load if the user clicks.
		
	});
	
    
    
}

</script>


<!-- script called when page is loaded but not called diring filters as searchrequest is set to 1 during filter click -->
<script>

$(document).ready(function() {
  //  alert("scroll");
    if(searchrequest!=1)
{
	$('#content').scroll({
          notfound: 'No Results Found',

		nop     : 3, // The number of posts per scroll to be loaded
		offset  : 0, // Initial offset, begins at 0 in this case
		error   : 'No More Posts!', // When the user reaches the end this is the message that is
		                            // displayed. You can change this if you want.
		delay   : 500, // When you scroll down the posts will load after a delayed amount of time.
		               // This is mainly for usability concerns. You can alter this as you see fit
		scroll  : false // The main bit, if set to false posts will not load as the user scrolls. 
		               // but will still load if the user clicks.
		
	});
}	
});

</script>
 
    <script type="text/javascript" src="popup.js"></script>
        <!-- adc() called to print checked values of cuisinepopup in cuisine text field -->
        <script>
var c;
function adc()
{
    //var x=document.getElementById("frm1");
     //document.getElementById("w").innerHTML = x.elements[0].value;
     
     var str = "";
    var i = 1;
     while(i<7){
        
         var id = "a"+ i;
         
         
     if(document.getElementById(id).checked == true)
     {
         
        //document.getElementById("w").innerHTML = document.getElementById("a").value;
        
        str=str.concat(document.getElementById(id).value);
         str = str.concat(";")
        
        
     }
     i++;
     }
     //document.getElementById("dq").innerHTML = str;
     document.getElementById("dcuisinepopup").value = str;
     
}

</script>

<script>
  $('body,html').animate({ scrollTop: $('body').height() }, 800);
</script>

<script type="text/javascript">
$(document).ready(function(){
	$("#login_a").click(function(){
        $("#shadow").css({
		"height": document.documentElement.clientHeight
		});
		$("#shadow").css({
			"opacity": "0.7"
		});
		
		$("#shadow").fadeIn("normal");
         $("#login_form").fadeIn("normal");
		 $("#form1").fadeIn();
		 $("#form2").hide();
         $("#user_name").focus();
    });
	$("#cancel_hide").click(function(){
        $("#login_form").fadeOut("normal");
        $("#shadow").fadeOut();
   });
	$("#forgot_pwd").click(function(){
        $("#form1").fadeOut(1);
		$("#form2").show(1);
		//$("#login_form").stop();
          //alert("The paragraph is now hidden");//

		/*$("#login_form").fadeOut();
        $("#shadow").fadeOut();
		$("#shadow").css({
		"height": document.documentElement.clientHeight
		});
		$("#shadow").css({
			"opacity": "0.7"
		});
		
		$("#shadow").fadeIn();
         $("#forgotPassword_form").show();
        //$("#formOfLogin").hide();
         //$("#formOfForgotPassword").show();*/
		 $("#emailFgtPwd").focus();
    });
	
   $("#shadow").click(function(){
		$("#login_form").fadeOut("normal");
		$("#shadow").fadeOut();
	});
	$("#popupClose2").click(function(){
		$("#login_form").fadeOut("normal");
		$("#shadow").fadeOut();
	
	});
	
	
   $("#login").click(function(){
    
        username=$("#user_name").val();
        password=$("#password").val();
        $.ajax({
            type: "POST",
            url: "check.php",
            data: "name="+username+"&pwd="+password,
            success: function(result){
                var data = $.parseJSON(result);
                html  = data.log;
              
              alert(data.sess);
              if(data.sess=='true')
              {
                    window.location.href = 'checkout.php';    
              }
             
             alert(html);
              if(html=='true')
              {
                $("#login_form").fadeOut("normal");
				$("#shadow").fadeOut();
				$("#loginsee").fadeOut();
				$("#logoutsee").show();
				//$("#profile").html("<a href='logout.php' id='logout'>Logout</a>");
				
              }
              else
              {
                    $("#add_err").html("Wrong username or password");
              }
            },
            beforeSend:function()
			{
                 $("#add_err").html("Loading...")
            }
        });
         return false;
    });
	$("#fgtPwd").click(function(){
    
        
		emailFgtPwd=$("#emailFgtPwd").val();
         $.ajax({
            type: "POST",
            url: "forgot_valid.php",
            data: "email="+emailFgtPwd,
            success: function(html){
              //$("#login_form").html("yoyo1");
			  if(html=='true')
              {
                $("#add_err").hide();
				$("#form2").html("Please check your mail to change password");
				//$("#login_form").fadeOut("8000");
				//$("#shadow").fadeOut();
				//$("#loginsee").fadeOut();
				//$("#logoutsee").show();
				//$("#profile").html("<a href='logout.php' id='logout'>Logout</a>");
				
              }//$("#login_form").html("yoyo2");
              else
              {//$("#login_form").html("yoyo2");
                    $("#add_err").html("Email ID is not registered, please login/sign up to continue");
              }
            },
            beforeSend:function()
			{
                 $("#add_err").html("Loading...")
            }
        });
         return false;
    });
});
</script>
<script type="text/javascript" src="pageredirect.js"></script>

    

  
   </head>
    <body>
	

        <div id="bg">
           
            <header>


                <a href="index.php"><image id="logo" src="images\logo.png" alt="mealgaadi.com"></a>
                <div id="log_in" > <!--  Changed thid id name, in style.css  also    -->
                    <?php if($_SESSION['log']==false){?>
                    <ul id="loginsee">
                        <li style="display:inline-block;"><a href="sign_up.php"><image src="images\signup.png" alt="sign_up" ></a></li>
						<li style="display:inline-block;">						
						
							<div id="profile">
								<?php// if(isset($_SESSION['user_name'])){
									?>
									<!--<a href='logout.php' id='logout'>Log out</a>-->
								<?php //}else {?>
								<a id="login_a" href="#"><image src="images\sign_in.png" alt="sign_in" ></a>
								<?php //} ?>
							</div>
							<div id="login_form">
								<a id="popupClose2">x</a>
								<div class="err" id="add_err"></div>
								<div id="form1" style="position:absolute;">
								
								<form id="formOfLogin" action="check.php" method="post" data-validate="parsley">
									<label>Email Id:</label>
									<input type="text" id="user_name" name="user_name" data-required="true" data-type="email" data-trigger="keyup" data-validation-minlength="3" /><br>
									<label>Password:</label>
									<input type="password" id="password" name="password" data-required="true" data-trigger="keyup" data-validation-minlength="1" data-minlength="4" data-type="alphanum" />
									<label></label><br/>
									<input type="submit" id="login" value="Login" />
									<input type="button" id="cancel_hide" value="Cancel" />
								</form>
								<a id="forgot_pwd" href="#">Forgot Password ?</a>
								</div>
								<div id="form2" style="position:absolute;">
								<form id="formOfForgotPassword" action="forgot_valid.php" data-validate="parsley">
									<label>Email id:</label><input type="text" id="emailFgtPwd" name="emailFgtPwd" data-required="true" data-type="email" data-trigger="keyup" data-validation-minlength="3">
									<input type="submit" id="fgtPwd" value="Submit">
								</form>
								</div>
								
								<!--<a id="forgot_a" href="forgot.php">Forgot Password ?</a>-->
							</div>
							<div id="shadow" class="popup"></div>	
<!--							<a href="form.php"><image src="images\sign_in.png" alt="sign_in" ></a>-->
						</li>
                    </ul>
                    <?php //}
                    //else
                    //{*/?>
                    <ul id="logoutsee" style="display:none;">
                        <li ><?php echo 'Welcome '.$_SESSION['cust_name'];
                        if(isset($_SESSION['sign']))
                        {
                            echo $_SESSION['sign'];
                        }?>
                        </li>
                        <li ><a href="profile.php">My Account</a></li>
                        <li><a href="logout.php">Log Out</a></li>
                    </ul>
                    <?php }
					else
					{
                    ?>
					<ul id="logoutsee">
                        <li ><?php echo 'Welcome '.$_SESSION['cust_name'];
                        if(isset($_SESSION['sign']))
                        {
                            echo $_SESSION['sign'];
                        }?>
                        </li>
                        <li ><a href="profile.php">My Account</a></li>
                        <li><a href="logout.php">Log Out</a></li>
                    </ul>
					<?php }
					?>
                    
                    
                </div>
            </header>
                
            <?php ob_end_flush(); ?>

 