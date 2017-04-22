
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
    		 	var v= document.getElementsByClassName('error');
    		 	v[0].style.display ="block";
				v[0].innerHTML='Este campo no puede estar vacío';
				x[0].focus();					 	 
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
  		var v= document.getElementsByClassName('error');
    	v[0].style.display ="none";
  		}
		
}







	