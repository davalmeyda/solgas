function clienteDELETE(id_cli, row) {
	const data = new FormData();
	data.append('id_cli', id_cli);
	fetch('../controllers/clienteController.php?op=5', {
		method : 'POST',
		body: data
	})
	.then(res => res.json())
	.then(data => {
		var mensajeCliente = document.getElementById('mensajeCliente');
		if (data.STATUS === 'OK') {
	        mensajeCliente.innerHTML = `
	          <div class="alert alert-success alert-dismissible fade show" role="alert">
	            <strong>CORRECTO!</strong> Cliente eliminado correctamente.
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	          </div>
	        `;
	        $('#trClienteSELECT'+row).remove();
      	} else {
      		mensajeCliente.innerHTML = `
	          <div class="alert alert-danger alert-dismissible fade show" role="alert">
	            <strong>ERROR!</strong> No se pudo eliminar al cliente.
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	          </div>
	        `;
      	}
	})
}