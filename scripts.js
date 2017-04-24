
			function popupwindow(url, title, w, h) 
      {
    		var w = 1100;
    		var h = 300;
    	 	var left = Number((screen.width/2)-(w/2));
   		    var tops = Number((screen.height/2)-(h/2));
			
			
			ventana=window.open('','pop', 'toolbar=no, location=no, directories=no, status=no, menubar=no, 			scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+tops+', left='+left);
			
      }



function validacion()
	{	

	 
	  var x = document.getElementsByName("searchterm");

	 
					
    		 if (x[0].value == "" || x[0].value.length== 0 || /^\s*$/.test(x[0].value))
    		 {
    		 					
				x[0].focus();			

				$(document).ready(function(){
					$(".error").fadeIn("slow");
					
				});	

				return false;
    		 	 

    		 }else{
    		 		
					popupwindow();
    		 }
	}



function validacion2()
{	
	y=document.getElementsByName("searchterm").value;

		if( y != "" ) 
		{  	
  				$(document).ready(function(){
					$(".error").fadeOut("slow");
				});	
  		}
		
}




