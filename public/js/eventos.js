$(function(){
//############# ACTIVA EL ELEMENTO NAVBAR DEPENDIENDO DE LA URL #######
	//los id de los elementos del navbar siguen el formato:    "nav-" + "elemento de array navElem"
	var url = location.href;
	var incluido = ["events", "procedimiento", "user", "asistente", "paciente", "roles", "general"];
	var navElem = ["citas", "procedimientos", "doctores", "asistentes", "pacientes", "roles", "general"];

	for(var i = 0; i < incluido.length; i++){
		if(url.includes(incluido[i])){
			//Comprueba si la url es user para decidir que nav-item activar
			if(incluido[i] == "user"){
				if(url.includes("doctor")){
					$("#nav-"+navElem[2]).addClass('active');
					break;
				}else if (url.includes("asistente")){
					$("#nav-"+navElem[3]).addClass('active');
					break;
				} else {
					$("#nav-"+navElem[i]).addClass('active');
					break;
				}
			}
			else{
				$("#nav-"+navElem[i]).addClass('active');
				break;
			}
		}
	}
//####################################################################
});