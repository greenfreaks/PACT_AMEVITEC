const SERVER = 'http://localhost/MVC_PACT/';
//const SERVER = 'http://techbusiness.com.mx/PACT/';

$(document).ready(function() {
	//============================================================
	let btn_whatsapp = `<li class="hide-on-large-only"><a href="https://api.whatsapp.com/send?phone=527797966790&text=Buenas tardes, me gustaría solicitar información" target="_blank" class="btn-floating green tooltipped" data-position="left" data-tooltip="Pregúntanos"> <img class="fab-img" src="http://www.techbusiness.com.mx/img/social-networks/whatsapp-logo.svg"></a></li>

        <li class="hide-on-med-and-down"><a href="https://web.whatsapp.com/send?phone=527797966790&text=Buenas tardes, me gustaría solicitar información" target="_blank" class="btn-floating green tooltipped" data-position="left" data-tooltip="Pregúntanos"> <img class="fab-img" src="http://www.techbusiness.com.mx/img/social-networks/whatsapp-logo.svg"></a></li>`;

	let btn_fb = `<li><a href="https://www.facebook.com/TechBusinessMx" target="_blank" class="btn-floating blue tooltipped" data-position="left" data-tooltip="Síguenos"> <img class="fab-img" src="http://www.techbusiness.com.mx/img/social-networks/facebook-logo.png"></a></li>`;

	let btn_messenger = `<li><a href="https://m.me/TechBusinessMx/" target="_blank" class="btn-floating blue tooltipped" data-position="left" data-tooltip="Chatea on nosotros"> <img class="fab-img" src="http://www.techbusiness.com.mx/img/social-networks/messenger.png"></a></li>`;

	let floatingBtn = `<div id="featureHelp" class="tap-target red no-autoinit" data-target="menu">
                <div class="tap-target-content white-text">
                  <h5>Contactanos</h5>
                  <p>Has click en este boton para ver todas las formas de contactarnos</p>
                </div>
            </div>
            <div id="menu" class="fixed-action-btn">
                <a id="social-fab" class="btn-floating btn-large">
                    <i data-position="left" data-tooltip="Asistencia en línea" class="large material-icons box tooltipped">help_outline</i>
                </a>
                <ul>
                    ${btn_whatsapp}
                    ${btn_fb}
                    ${btn_messenger}
                    <li class="hide-on-med-and-up"><a href="tel:017797966790" class="btn-floating green tooltipped" data-position="left" data-tooltip="Llamanos 7797966790"> <i class="large material-icons box">phone</i></a></li>
                    <li><a href="mailto:contacto@techbusiness.com.mx" class="btn-floating purple tooltipped" data-position="left" data-tooltip="Email"> <i class="large material-icons box">mail</i></a></li>
                </ul>
            </div>`;

	$(floatingBtn).appendTo('body');

	//============================================================

	let modal_message = `<div id="modal-message" class="modal modal-fixed-footer">
  <div class="modal-content center">
      <div class="row">
          <div id="modal-message-icon" class="col s2">
          </div>
          <div class="col s10 center">
              <h4 id="modal-message-title"></h4>
          </div>
      </div>
      <div class="row"> 
          <div class="col s12">
              <h5 id="modal-message-msg">message</h5>
          </div>
      </div>
  </div>
  <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
  </div>
</div>`;

	$(modal_message).appendTo('body');

	let loadingModalString = `<div id="loading" class="modal">
                <div class="modal-content center">
					<h4>Espere un momento</h4>
                    <div class="progress">
                        <div class="indeterminate"></div>
                    </div>
                </div>
			</div>`;

	$(loadingModalString).appendTo('body');

	M.AutoInit();

	let loadingModal = M.Modal.init(document.querySelector('#loading'), {
		dismissible: false
	});

	let sidenav = M.Sidenav.init(document.querySelector('#slide-out'), {
		menuWidth: 250
	});
});

//================Funciones globales

function objectifyForm(formArray) {
	//serialize data function

	var returnArray = {};
	for (var i = 0; i < formArray.length; i++) {
		returnArray[formArray[i]['name']] = formArray[i]['value'];
	}
	return returnArray;
}

function ts(cb) {
	if (cb.readOnly) cb.checked = cb.readOnly = false;
	else if (!cb.checked) cb.readOnly = cb.indeterminate = true;
}

function sendMessage(messageType, title, message) {
	$('#modal-message-title').html(title);
	$('#modal-message-msg').html(message);

	switch (messageType) {
		case 1:
			// error
			$('#modal-message-icon').html(
				`<i  class="material-icons medium red-text">error</i>`
			);
			break;
		case 2:
			// warning
			$('#modal-message-icon').html(
				`<i  class="material-icons medium yellow-text">warning</i>`
			);
			break;
		default:
			// info
			$('#modal-message-icon').html(
				`<i  class="material-icons medium blue-text">info</i>`
			);
	}

	$('#modal-message').modal('open');
}
