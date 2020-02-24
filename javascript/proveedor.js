function frmProveedorINSERT_CLEAN() {
	$('#nbrRuc_prov').val('');
	$('#txtRazsoc_prov').val('');
	$('#txaDireccion_prov').val('');
}
function proveedorDELETE(id_prov, row) {
	const data = new FormData();
	data.append('id_prov', id_prov);
	fetch('../controllers/proveedorController.php?op=5', {
		method : 'POST',
		body: data
	})
	.then(res => res.json())
	.then(data => {
		var mensajeProveedor = document.getElementById('mensajeProveedor');
		if (data.STATUS === 'OK') {
	        mensajeProveedor.innerHTML = `
	          <div class="alert alert-success alert-dismissible fade show" role="alert">
	            <strong>CORRECTO!</strong> Proveedor eliminado correctamente.
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	          </div>
	        `;
	        $('#trProveedorSELECT'+row).remove();
      	} else {
      		mensajeProveedor.innerHTML = `
	          <div class="alert alert-danger alert-dismissible fade show" role="alert">
	            <strong>ERROR!</strong> No se pudo eliminar al proveedor.
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	          </div>
	        `;
      	}
	})
}