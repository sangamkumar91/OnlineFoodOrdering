<?php
 include 'header1.php'; 
//$customer_fname = "Anshul";
session_start();
$authenticated = isset($_SESSION['log']);
if($authenticated)
{
	$customer_id = $_SESSION['cust_id'];
	
//	$customer_id= 1;
	@$db = new mysqli('localhost', 'root', '', 'futurecaptcha');
	if($db->connect_errno!=0)
	{
		echo $db->connect_error ;
		exit;
	}
	else
	{

?>
		<!DOCTYPE html>
		<html>

		<head>
			<meta charset='UTF-8'>
		
			<title>Profile</title>
			<link rel='stylesheet' href='style.css'>
			<link rel='stylesheet' href='css/style.css'>
			<!--<script type="text/javascript" src="jquery.min.js"></script>
			<script type="text/javascript" src="parsley.min.js"></script>-->
			
	
	<!-- You COULD just put both menus in the markup,
	     but if you don't like that, this is how you
	     could dynamically create it with jQuery.  -->
			
			
			<script>
			 // DOM ready
			 $(document).ready(function() {
			   
			  // Create the dropdown base
			  $("<select />").appendTo("nav");
			  
			  // Create default option "Go to..."
			  $("<option />", {
				 "selected": "selected",
				 "value"   : "",
				 "text"    : "Go to..."
			  }).appendTo("nav select");
			  
			  // Populate dropdown with menu items
			  $("nav a").each(function() {
			   var el = $(this);
			   $("<option />", {
				   "value"   : el.attr("href"),
				   "text"    : el.text()
			   }).appendTo("nav select");
			  });
			  
			   // To make dropdown actually work
			   // To make more unobtrusive: http://css-tricks.com/4064-unobtrusive-page-changer/
			  $("nav select").change(function() {
				window.location = $(this).find("option:selected").val();
			  });
			 
			 });
			</script>
			<!--<script type='text/javascript' src='http://code.jquery.com/jquery.min.js'></script>-->
			<script type='text/javascript'>
			<?php
				$query = "SELECT * FROM customers WHERE customer_id='$customer_id'";
				$results = $db->query($query);
				if($row = $results->fetch_assoc()){
				$customer_fname = $row['customer_fname'];
				$customer_sname = $row['customer_sname'];
				$customer_email = $row['customer_email'];
				$customer_contact_one = $row['customer_contact_1'];
				$customer_contact_two = $row['customer_contact_2'];}
			?>
				

			$(document).ready(function(){
				 $('.saveInput').keyup(function(){
					  if (($(this).val() == '') || (($('#profileFirstName').val() == '<?php echo $customer_fname;?>') && ($('#profileLastName').val() == '<?php echo $customer_sname;?>') && ($('#profileEmail').val() == '<?php echo $customer_email;?>') && ($('#profileFirstContact').val() == '<?php echo $customer_contact_one;?>') && ($('#profileSecondContact').val() == '<?php echo $customer_contact_two;?>'))) {
						   $('.enableOnInput').prop('disabled', true);
					  } else {
						   $('.enableOnInput').prop('disabled', false);
					  }
				 });
			});
			</script>

		</head>

		<body>
		<div id="bg">
			<div id="container">
			
				<div id="tabs">
					<nav>
						<ul>
							<li><a href="profile.php" class="active">Profile</a></li>
							<li><a href="editContactInfo.php">Edit Contact Info</a></li>
							<li><a href="placedOrders.php">Placed Orders</a></li>
							<li><a href="favourites.php">Favourites</a></li>
						</ul>
					</nav>	
				</div>
				<div id="profileinfo">
					<?php
						$action = isset($_GET['action'])?$_GET['action']:NULL;
						if(($action==NULL) || ($action!='savedata'))
						{
							$query = "SELECT * FROM customers WHERE customer_id='$customer_id'";
							$results = $db->query($query);
							if($row = $results->fetch_assoc()){
							$customer_fname = $row['customer_fname'];
							$customer_sname = $row['customer_sname'];
							$customer_email = $row['customer_email'];
							$customer_contact_one = $row['customer_contact_1'];
							$customer_contact_two = $row['customer_contact_2'];}

					?>		
							<form action="profile.php" data-validate="parsley" method="get" style="padding-left:10%;">
						

								<ul class="customer_profile">
									<li>	
										<ul class="customer_details" id="firstNameErrorContainer">
											<li class="customer"><?php echo "First Name :"; ?></li>
											<li><input class="saveInput" id="profileFirstName" type="text" name="firstname" value='<?php echo "$customer_fname"; ?>' data-required="true" data-trigger="keyup" data-regexp="^[A-Za-z ]" data-validation-minlength="1" data-error-container="#firstNameErrorContainer" data-error-message="*Required.Must be alphabets only"></li>
										</ul>
									</li>
									<li>
										<ul class="customer_details" id="lastNameErrorContainer">
											<li class="customer"><?php echo "Last Name :"; ?></li>
											<li><input type="text" class="saveInput" id="profileLastName" name="lastname" value='<?php echo "$customer_sname"; ?>' data-required="true" data-trigger="keyup" data-regexp="^[A-Za-z ]" data-validation-minlength="1" data-error-container="#lastNameErrorContainer" data-error-message="*Required.Must be alphabets only"></li>
										</ul>
									</li>
									<li>
										<ul class="customer_details" id="emailErrorContainer">
											<li class="customer"><?php echo "Email id :"; ?></li>
											<li><input type="text" class="saveInput" id="profileEmail" name="email" value='<?php echo "$customer_email"; ?>' data-required="true" data-type="email" data-trigger="keyup" data-validation-minlength="3" data-error-container="#emailErrorContainer" data-error-message="*Required.Must be in the format: yourId@example.com"></li>
										</ul>
									</li>
									<li>
										<ul class="customer_details" id="firstContactErrorContainer">
											<li class="customer"><?php echo "Contact Number(home):"; ?></li>
											<li><input type="text" class="saveInput" id="profileFirstContact" name="first_contact" value='<?php echo "$customer_contact_one";?>' data-required="true"  data-trigger="keyup" data-type="phone" data-error-container="#firstContactErrorContainer"></li>
										</ul>
									</li>
									<li>
										<ul class="customer_details" id="secondContactErrorContainer">
											<li class="customer"><?php echo "Contact Number(other):"; ?></li>
											<li><input type="text" class="saveInput" id="profileSecondContact" name="second_contact" value='<?php echo "$customer_contact_two";?>' data-trigger="keyup" data-type="phone" data-error-container="#secondContactErrorContainer"></li>
										</ul>
									</li>
								</ul>
								<input class="enableOnInput" type="submit" value="Save" disabled='disabled'>
								<input type="hidden" name="action" value="savedata">
							</form>
							
					<?php
						}

						elseif($action=='savedata')
						{
							$firstname = filter_input(INPUT_GET,'firstname',FILTER_SANITIZE_STRING);
							$lastname = filter_input(INPUT_GET,'lastname',FILTER_SANITIZE_STRING);
							$email = filter_input(INPUT_GET,'email',FILTER_SANITIZE_EMAIL);
							$first_contact = filter_input(INPUT_GET,'first_contact',FILTER_SANITIZE_NUMBER_INT);
							$second_contact = filter_input(INPUT_GET,'second_contact',FILTER_SANITIZE_NUMBER_INT);
							if(isset($email) && !empty($email) AND isset($firstname) && !empty($firstname) AND isset($lastname) && !empty($lastname) AND isset($first_contact) && !empty($first_contact) AND isset($second_contact))
							{
								if (!filter_var($email,FILTER_VALIDATE_EMAIL))
								{
										echo "E-Mail is not valid".'<br>';
										echo "<a href=\"profile.php\">Click here</a>"." to enter again";
										echo "<br/>";
										

								}
								else
								{
									$email = mysql_real_escape_string($email);
									$firstname = mysql_real_escape_string($firstname);
									$lastname = mysql_real_escape_string($lastname);
									$first_contact = mysql_real_escape_string($first_contact);
									$second_contact = mysql_real_escape_string($second_contact);
									$query = "UPDATE customers SET customer_fname='$firstname', customer_sname='$lastname', customer_email='$email', customer_contact_1='$first_contact', customer_contact_2='$second_contact'
									WHERE customer_id='$customer_id'";
									$db->query($query);
									echo "Changes saved successfully<br/>";
								} 
							}
							else
							{
								echo "One or more field is empty. Please ";
								echo "<a href=\"profile.php\">Click here</a>"." to enter again";
								echo "<br/>";
							}
						
					?>
							<a href="profile.php">BACK</a>
					<?php

						}	
					?>
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
$db->close();
	}
}
else
{
	echo "Kindly log in to continue<br/>";
}
?>