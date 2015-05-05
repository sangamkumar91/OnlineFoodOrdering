<?php
require 'header1.php';
?>
<body  onkeyup="showResult();" onload="showResult();" >
    <html>
<?php
mysql_connect('localhost', 'root', '') or die();
mysql_select_db('futurecaptcha');
if (!$_POST[admin_login])
{
?>


<form action="admin.php" method="post" >
<label>Email Id:</label>
<input type="text" name="user_name" data-required="true" /><br>
<label>Password:</label>
<input type="password"  name="password" />
<label></label><br/>
<input type="submit" name="admin_login" value="Login" />
</form>
        

<?php
}

else{
    $usr=$_POST[user_name];
    $pwd=$_POST[password];
    
    $query = "SELECT * FROM  `admin` where username='$usr' and password ='$pwd'";
   $result2 = mysql_query($query) or die(mysql_error());
   
  $num_rows = mysql_num_rows($result2);
        if ($num_rows != 0) {
            
            
            
            echo ("welcome Administrator");
            
            ?>
        
        
<script type="text/javascript">
	   function showResult()
	   {
               
               
	   	
	   		var obj =  new XMLHttpRequest();
	   		obj.open('GET','process.php',true);
	   		obj.send();
            obj.onreadystatechange = function(){
            	if(obj.readyState == 4 && obj.status == 200){
            		document.getElementById('result').innerHTML=obj.responseText;
            	}
            }
     //if(document.getElementById("status1").value == "leaving")
        //        {
	   counter();	
             //   }
	   	
	   }
	</script>
        
       
        
      
        
        
         <div id="result" >
            
        </div>
        <table>
        <tr><td><input type="button" id="free" value ="free1" onclick="showResult1(1);"></td></tr>
        <tr><td><input type="button" id="free" value ="free2" onclick="showResult1(2);"></td></tr>
        <tr><td><input type="button" id="free" value ="free3" onclick="showResult1(3);"></td></tr>
        <tr><td><input type="button" id="free" value ="free4" onclick="showResult1(4);"></td></tr>
        </table>
            
            
        <?php  
        }
        
        
        
        else
        {
            ?>
        <script>
            
            alert("Wrong admin id  or password... Please try again");
            
           
            
            </script>
        


<form action="admin.php" method="post" >
<label>Email Id:</label>
<input type="text" name="user_name" data-required="true" /><br>
<label>Password:</label>
<input type="password"  name="password" />
<label></label><br/>
<input type="submit" name="admin_login" value="Login" />
</form>
        


        
        <?php
            
            
            
        
        }
}
    
    


?>

        </html>
        </body>
    <script type="text/javascript">
	   function showResult1(key1)
	   {
	   	
	   	
	   		var obj = new XMLHttpRequest();
	   		obj.open('GET','process1.php?key1='+key1,true);
	   		obj.send();
            obj.onreadystatechange = function(){
            	if(obj.readyState == 4 && obj.status == 200){
            		document.getElementById('result').innerHTML=obj.responseText;
            	}
            }
	   	
	   }
	</script>
        <script>
        function showResult2(key1)
	   {
	   	
	   	
	   		var obj = new XMLHttpRequest();
	   		obj.open('GET','process2.php?key1='+key1,true);
	   		obj.send();
            obj.onreadystatechange = function(){
            	if(obj.readyState == 4 && obj.status == 200){
            		document.getElementById('result').innerHTML=obj.responseText;
            	}
            }
	   	
	   }
	</script>
          <script>
             function counterdec(c,s){
                  alert(c);
                var time = document.getElementById(c).value;
                //alert(time);
                if(time >0){
        time= time-1;
        document.getElementById(c).value = time;
        
            setTimeout(counterdec(c,s),1000);
                }
                else{
                    document.getElementById(s).value = "left";
                  if(c=="counter1")
            showResult2(1);
        if(c=="counter2")
            showResult2(2);
        if(c=="counter3")
            showResult2(3);
        if(c=="counter4")
            showResult2(4);
                    
                }
                }
            
           
                
            
          function counter(){
              
              var c;
              var s;
              c= "counter1";
                    s = "status1";
              if(document.getElementById("status1").value = "left")
                  {
                      alert("111");
                    c= "counter2";
                    s = "status2";
                  }
              else{
              if(document.getElementById("status2").value = "left")
                  {
                      c= "counter3";
                    s = "status3";
                  }
              else{
                  if(document.getElementById("status3").value = "left")
                      {
                    c= "counter4";
                    s = "status4";
                      }
                  
                }
                }
            
           
              
              if(document.getElementById(s).value == "leaving")  
             document.getElementById(c).value = 40;
                
          
       counterdec(c,s);
      
          }
      
        
            
        </script>
        

