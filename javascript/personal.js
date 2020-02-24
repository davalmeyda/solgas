function tipo_userCHANGE(valor) {
	if (valor == '00000') {
		$('#divRegistro').css('display','none');
		$('#txtUsuario_per').removeAttr('required');
		$('#pwdClave_per').removeAttr('required');
	} else {
		$('#divRegistro').css('display','');
		$('#txtUsuario_per').removeAttr('required');
		$('#txtUsuario_per').attr('required','true');
		$('#pwdClave_per').removeAttr('required');
		$('#pwdClave_per').attr('required','true');
	}
}
function frmPersonalINSERT_CLEAN() {
	$('#txtNombre_per').val('');
	$('#txtApellido_per').val('');
	$('#txtNacionalidad_per').val('');
	$('#nbrNumdoc_per').val('');
	$('#txtUsuario_per').val('');
	$('#pwdClave_per').val('');
}
function personalDELETE(id_per, row) {
	const data = new FormData();
	data.append('id_per', id_per);
	fetch('../controllers/personalController.php?op=5', {
		method : 'POST',
		body: data
	})
	.then(res => res.json())
	.then(data => {
		var mensajePersonal = document.getElementById('mensajePersonal');
		if (data.STATUS === 'OK') {
	        mensajePersonal.innerHTML = `
	          <div class="alert alert-success alert-dismissible fade show" role="alert">
	            <strong>CORRECTO!</strong> Personal eliminado correctamente.
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	          </div>
	        `;
	        $('#trPersonalSELECT'+row).remove();
      	} else {
      		mensajePersonal.innerHTML = `
	          <div class="alert alert-danger alert-dismissible fade show" role="alert">
	            <strong>ERROR!</strong> No se pudo eliminar al personal.
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	          </div>
	        `;
      	}
	})
}