//Autocomplete con jquery

// $(document).ready(function() {
//     $("#resultadoBusqueda").html('<p>JQUERY VACIO</p>');
// });

// function buscar() 
// {
//     var textoBusqueda = $("input#searchterm").val();
 	
 	
//      if (textoBusqueda != "") {
//         $.post("buscar.php", 
//         	{valorBusqueda: textoBusqueda
//         		}, function(mensaje) 
//         			{
//            			 $("#resultadoBusqueda").html(mensaje);
           			 
//         		    }); 
     
//      } else { 
//         $("#resultadoBusqueda").html('<p>JQUERY VACIOs</p>');
//         };
// };




function popupwindow(url, title, w, h) 
	{
    		var w = 1040;
    		var h = 370;
    	 	var left = Number((screen.width/2)-(w/2));
   		    var tops = Number((screen.height/2)-(h/2));
			
			
			var ventana=window.open('','pop', 'toolbar=no, location=no, directories=no, status=no, menubar=no,scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+tops+', left='+left);
    }



function validacion()
	{	

	 
	  var x = document.getElementsByName("searchterm");

	 
					
    		 if (x[0].value == "" || x[0].value.length== 0 || /^\s*$/.test(x[0].value))
    		 {
    		 					
				x[0].focus();			

				$(document).ready(function(){
					$(".errortext").text('Este campo no puede estar vacío');
					$(".error").fadeIn("slow");
					$(".tabla").fadeOut("slow");
					
				});	

				return false;
    		 	 

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

function validacion3()
{	
				y=document.getElementsByName("searchterm").value;

  				$(document).ready(function(){
  					
					$(".errortext").text('no se encontraron coincidencias con la búsqueda');
					$(".error").fadeIn("slow");
					$("#searchterm").focus();
					
				});	
  	
		
}




function hide()
{

					$(document).ready(function(){
					$(".left").css('display','none');
					$(".menu").css('display','none');
					$(".left2").css('display','block');
					$(".menu2").css('display','block');
					});	

}

function show()
{

					$(document).ready(function(){
					$(".left").css('display','block');
					$(".menu").css('display','block');
					$(".left2").css('display','none');
					$(".menu2").css('display','none');
					});	

}


