$(document).ready(function(){
	var link = window.location.href;

	if(link.includes("reservar")){
		$("#nav_reservar").addClass('active').siblings().removeClass('active');
	}
	else if(link.includes("documentar")){
		$("#nav_documentar").addClass('active').siblings().removeClass('active');
	}
	else if(link.includes("facturar")){
		$("#nav_facturar").addClass('active').siblings().removeClass('active');
	}
	else if(link.includes("check_in")){
		$("#nav_check_in").addClass('active').siblings().removeClass('active');
	}
	else if(link.includes("administracion") || link.includes("administrar")){
		$("#nav_administracion").addClass('active').siblings().removeClass('active');
	}
	else{
		$("#nav_inicio").addClass('active').siblings().removeClass('active');
	}

	if($("#nav_administracion").hasClass('active')){
		if(link.includes("empleado")){
			$("#admin_imagen").attr("src","http://localhost/traveler-airlines/images/empleados.png");
		}
		else if(link.includes("aviones")){
			$("#admin_imagen").attr("src","http://localhost/traveler-airlines/images/aviones.png");
		}
		else if(link.includes("vuelos")){
			$("#admin_imagen").attr("src","http://localhost/traveler-airlines/images/vuelos.png");
		}
		else{
			
		}
	}
});