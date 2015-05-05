<!DOCTYPE html>
<html>
<head>
<script>
var c;
function adc()
{
    //var x=document.getElementById("frm1");
     //document.getElementById("w").innerHTML = x.elements[0].value;
     var str = "";
    
     
     if(document.getElementById("a").checked == true)
     {
        //document.getElementById("w").innerHTML = document.getElementById("a").value;
        str=str.concat(document.getElementById("a").value);
        
     }
     else
     {
        //document.getElementById("w").innerHTML = null;
     }
     if(document.getElementById("b").checked == true)
     {
        str = str.concat(",")
        //document.getElementById("d").innerHTML = document.getElementById("b").value;
        str=str.concat(document.getElementById("b").value);
     }
     else
     {
        //document.getElementById("d").innerHTML = null;
     }
     document.getElementById("dq").innerHTML = str;
     document.getElementById("dw").value = str;
     var variableToSend = 'foo';
     $.post('file.php', {variable: variableToSend});
}
function formSubmit()
{
    adc();
    if(c>7)
    {
        document.getElementById("frm1").submit();
    }
    else
    {
        alert('asdc');
    }
}
</script>
</head>
<body>

<p>Enter some text in the fields below, then press the "Submit form" button to submit the form.</p>
<p id="w"></p>
<p id="d"></p>
<p id="dq"></p>
<input id="dw" type="text"  />

<input id="a" type="checkbox" name="vehicle" value="Bike" onclick="adc()">I have a bike<br>
<input id="b" type="checkbox" name="vehicle" value="Car" onclick="adc()">I have a car <br>
<input type="button" onclick="formSubmit()" value="Submit form">


</body>
</html>