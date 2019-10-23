$(document).ready(function(){



});
	
function validar(){
    var email = document.getElementById("email").value;
    var contrasenia = document.getElementById("contraseña").value;
    alert(email);
    alert(contrasenia);
    
    $.ajax({
	    type:"POST",
	    url: "../controller/cLogin.php", 
	    datatype: "json",  //type of the result
	    data:{'email':email,'contrasenia':contrasenia},
	    success: function(result){

	        var usuarios = JSON.parse(result);
	        alert(result);
	        console.log(result);
	        if(result){
	        	 window.location.href = adim.html;
	        }else{
	        	
	        }
	        	
	 },
	    error : function(xhr) {
	        alert("An error occured: " + xhr.status + " " + xhr.statusText);
	    }
	});
    
  }