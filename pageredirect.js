
// all checkboxes value is unset by checked= false....and slider values are made default   and returned to their corresponding textboxes

function clearfilter()
  {
     
    document.getElementById("veg").checked = false ;
    document.getElementById("nonveg").checked = false ;
  
    document.getElementById("credit").checked = false ;
    
    document.getElementById("ac").checked = false ;
    
    document.getElementById("freedev").checked = false ;
    
    document.getElementById("alcohol").checked = false ;
    
    document.getElementById("catering").checked = false ;

    document.getElementById("wifi").checked = false ;
  
    
    document.getElementById("currenttime1").checked = false ;
    
  
		$( "#slider-range-cf2" ).slider({
			range: true,
			min: 0,
			max: 4000,
			values: [ 0, 4000 ]});
                    $( "#cf2min" ).val( $( "#slider-range-cf2" ).slider( "values", 0 )); 
$( "#cf2max" ).val( $( "#slider-range-cf2" ).slider( "values", 1 ));		



$( "#slider-range-time" ).slider({
			range: true,
			min: 0,
			max: 1439,
			values: [ 0, 1439 ]});
                    
                     $( "#opentime" ).val("00:00");
                    $( "#closetime" ).val("23:59");
                   
                   $( "#opentime1" ).val("12:00 AM");
                    $( "#closetime1" ).val("11:59 PM");
			
            
 	//pass function called to displat unfiltered results
   
   pass();
    
  }