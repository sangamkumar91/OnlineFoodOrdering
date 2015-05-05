function popupcheck(popuptype){
    
//popuptype is the name of the field which should the property of a function e.g cuisine 
var popupStatus = 0;
var mypopupid="#" + popuptype + "popup";
var bgmypopupid="#bg" + popuptype + "popup";
var dmypopupid = "#d" + popuptype + "popup";



		//centering with css
		centerPopup();
		//load popup
		loadPopup();


function loadPopup(){
	if(popupStatus==0){
		$(bgmypopupid).css({
			"opacity": "0.7"
		});
		$(bgmypopupid).fadeIn("slow");
		$(mypopupid).fadeIn("slow");
		popupStatus = 1;
	}
}

function disablePopup(){
	if(popupStatus==1){
		$(bgmypopupid).fadeOut("slow");
		$(mypopupid).fadeOut("slow");
		popupStatus = 0;
	}
}

//centering popup
function centerPopup(){
	//request data for centering
	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	var popupHeight = $(mypopupid).height();
	var popupWidth = $(mypopupid).width();
	

	$(mypopupid).css({
		"position": "absolute",
		"top": windowHeight/2-popupHeight/2,
		"left": windowWidth/2-popupWidth/2
	});
	
	$(bgmypopupid).css({
		"height": windowHeight
	});
}



				
	//CLOSING POPUP
	//Click the x event!
	$("#popupClose").click(function(){
		disablePopup();
	});
	//Click out event!
	$(bgmypopupid).click(function(){
		disablePopup();
	});
	//Press Escape event!
	$(document).keypress(function(e){
		if(e.keyCode==27 && popupStatus==1){
			disablePopup();
		}
	});


}