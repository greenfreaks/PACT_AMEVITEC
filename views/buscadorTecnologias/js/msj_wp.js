document.querySelector('#submit_wp').addEventListener('click',function(){

	let id = document.querySelector('#id').value;
	let grado = document.querySelector('#grado').value;
	let titulo = document.querySelector('#titulo').value;
	let escuela = document.querySelector('#escuela').value;
	let organizacion = document.querySelector('#organizacion').value;
	let funcion = document.querySelector('#funcion').value;
	let campo = document.querySelector('#campo').value;
	let disciplina = document.querySelector('#disciplina').value;
	let subdisciplina = document.querySelector('#subdisciplina').value;
	let	url = "https://api.whatsapp.com/send?phone=525619238733&text=¿Qué tal? Quisiera solicitar más información acerca del talento que tiene los siguientes datos: *%0A%0A* ID del usuario: *"+ id +"* *%0A* Grado: *"+ grado +"*  *%0A* Título: *"+ titulo +"* *%0A* Escuela: *"+ escuela +"* *%0A* Organización: *"+ organizacion +"* *%0A* Función: *"+ funcion +"* *%0A* Campo: *"+ campo +"* *%0A* Disciplina: *"+ disciplina +"* *%0A* Subdisciplina: *"+ subdisciplina +"* ";

	window.open(url);
})