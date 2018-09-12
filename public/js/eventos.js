$(function(){
//############# ACTIVA EL ELEMENTO NAVBAR DEPENDIENDO DE LA URL #######
	//los id de los elementos del navbar siguen el formato:    "nav-" + "elemento de array navElem"
	var url = location.href;
	var incluido = ["events", "procedimiento", "user", "asistente", "paciente", "roles"];
	var navElem = ["citas", "procedimientos", "doctores", "asistentes", "pacientes", "roles"];

	for(var i = 0; i < incluido.length; i++){
		if(url.includes(incluido[i])){
			$("#nav-"+navElem[i]).addClass('active');
			break;
		}
	}
//####################################################################
});