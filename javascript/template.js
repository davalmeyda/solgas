function CargarNotificacionesPersonal() {
	fetch('../controllers/mapsController.php?op=15')
	.then(res => res.json())
	.then(data => {
		if (data.STATUS == 'OK') {
			var rowNoti = `<span class="dropdown-item dropdown-header">${data.DATA.length} Notificaciones</span>`;
			for (var i in data.DATA) {
				rowNoti += `
					<div class="dropdown-divider"></div>
			        <a href="javascript:ajaxPagina('content','./maps/maps.php?id_ven=${data.DATA[i].id_ven}&estado_rutmap=1')" class="dropdown-item">
			            <i class="fas fa-route mr-2"></i> ${data.DATA[i].nombres_adm}
			            <span class="float-right text-muted text-sm"> ${data.DATA[i].nfecha_rutmap}</span>
			            <h6 class="text-center">${data.DATA[i].nombre_ven}</h6>
			        </a>
				`;
			}
			$('#spnNotificaciones').text(data.DATA.length);
			$('#divNotificaciones').html(rowNoti);
			setTimeout(function(){CargarNotificacionesPersonal();},1000);
		}
	})
}
function CargarNotificacionesAdmin() {
	var rowNoti = '';
	var nNoti = 0;
	fetch('../controllers/mapsController.php?op=16&op2=1')
	.then(res => res.json())
	.then(data => {
		if (data.STATUS == 'OK') {
			rowNoti += `<span class="dropdown-item dropdown-header">${data.DATA.length} Notificaciones SOAT</span>`;
			for (var i in data.DATA) {
				rowNoti += `
					<div class="dropdown-divider"></div>
			        <a href="#" class="dropdown-item">
			            <i class="fas fa-route mr-2"></i> Soat vencido <br> vehiculo de placa ${data.DATA[i].placa_veh}
			            <span class="float-right text-muted text-sm"> ${data.DATA[i].nsoatven_veh}</span>
			   		</a>
				`;
			}
			nNoti = parseInt(nNoti) + parseInt(data.DATA.length);
			fetch('../controllers/mapsController.php?op=16&op2=2')
			.then(res => res.json())
			.then(data2 => {
				if (data2.STATUS == 'OK') {
					rowNoti += `<span class="dropdown-item dropdown-header">${data2.DATA.length} Notificaciones RUTAS</span>`;
					for (var i in data2.DATA) {
						rowNoti += `
							<div class="dropdown-divider"></div>
					        <a href="#" class="dropdown-item">
					            <i class="fas fa-route mr-2"></i> ${data2.DATA[i].nombres_per}`;
					if (data2.DATA[i].estado_rutmap == 2) {
					    rowNoti += `<span class="float-right text-muted text-sm"> ${data2.DATA[i].nfecha_rutmap}</span>
					   				<h6 class="text-center">${data2.DATA[i].nombre_ven}&nbsp;&nbsp;&nbsp;ACEPTADO</h6>`;
					}
					if (data2.DATA[i].estado_rutmap == 3) {
					    rowNoti += `<span class="float-right text-muted text-sm"> ${data2.DATA[i].nfecfin_rutmap}</span>
					   				<h6 class="text-center">${data2.DATA[i].nombre_ven}&nbsp;&nbsp;&nbsp;RECHAZADO</h6>`;
					}
					    rowNoti += `</a>
						`;
					}
					nNoti = parseInt(nNoti) + parseInt(data2.DATA.length);
					$('#spnNotificaciones').text(nNoti);
					$('#divNotificaciones').html(rowNoti);
				}
			})
		}
	})
	setTimeout(function(){CargarNotificacionesAdmin();},1000);
}
function RegistrarBalones(id_ven) {
	fetch('../controllers/ventasController.php?op=8&id_ven='+id_ven)
	.then(res => res.json())
	.then(data => {
		if (data.STATUS == 'OK') {
			var row = '';
			var count = 0;
			var cantidad_balven = '';
			var id_bal = '';
			var id_balven = '';
			var descripcion_balven = '';
			for (var j in data.DATA) {
				cantidad_balven = parseInt(data.DATA[j].cantidad_balven);
				id_bal = data.DATA[j].id_bal;
				id_balven = data.DATA[j].id_balven;
				descripcion_balven = data.DATA[j].descripcion_balven;
				for (var i=0;i<data.DATA[j]['cantidad_balven'];i++) {
					if (data.DATA[j]['balonxu'][i].codbar_balxu != '') {
						row += `<tr>
								<td>${parseInt(count)+1}</td>
								<td>${descripcion_balven}</td>
								<td>${data.DATA[j]['balonxu'][i].codbar_balxu}</td>
								<td>${data.DATA[j]['balonxu'][i].fecha_balxuven}</td>
								<input type="hidden" id="id_balxu${count}" value="${data.DATA[j]['balonxu'][i].id_balxu}">
								<input type="hidden" id="id_balven${count}" value="${data.DATA[j].id_balven}">
							</tr>`;
					} else {
						balonxuSELECT(count,id_bal);
						row += `
							<tr>
								<td>${parseInt(count)+1}</td>
								<td>${descripcion_balven}</td>
								<td>
									<select id="id_balxu${count}" class="form-control"></select>
								</td>
								<td></td>
								<input type="hidden" id="id_balven${count}" value="${data.DATA[j].id_balven}">
							</tr>
						`;
					}
					count++;
				}
			}
			$('#tblBalonxu_venta > tbody').html(row);
			modalShow('mdlMostrarVentaDetalle');
		}
	});
}
function balonxu_ventaINSERT() {
	var id_balxu = '';
	if (verificarbalones_venta() === true) {
		var listBalxu = [];
		var nfilas = $('#tblBalonxu_venta > tbody > tr').length;
		for (var i = 0; i < nfilas; i++) {
			if ($(`select[id='id_balxu${i}']`).length) {
				listBalxu.push({
					'id_balxu': $('#id_balxu'+i).val(),
					'id_balven': $('#id_balven'+i).val()
				});
			}
		}
		var cabecera = {
			'listBalxu': listBalxu
		}
	    var data = JSON.stringify(cabecera);
		console.log(data)
		__ajax('../controllers/ventasController.php?op=9','POST','JSON',{'data' : data})
		.done(function(info) {
			if (info.STATUS == 'OK') {
				$('#msjMaps >').remove();
				$('#msjMaps').append(`
					<div class="alert alert-success alert-dismissible fade show" role="alert">
					  <strong>CORRECTO!</strong> Registro de balones correcto
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
				`);
				$('#mdlMostrarVentaDetalle').modal('hide');
			} else {
				$('#msjMaps >').remove();
				$('#msjMaps').append(`
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
					  <strong>OH NO!</strong> No puedes registrar el balon al prestamo.
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
					`);
				$('#mdlMostrarVentaDetalle').modal('hide');
			}
		});
	}
}
function verificarbalones_venta() {
    flat = false;
	var nfilas = $('#tblBalonxu_venta > tbody > tr').length;
	for (var j = 0; j < nfilas; j++) {
		for (var i = 0; i < nfilas; i++) {
	        if($("#id_balxu"+j).val() == $("#id_balxu"+i).val()  && j != i){
	            flat = true;
	        }
	    }
	    if(flat){
			$('#msjmdlProducto').html(`
	    		<div class="alert alert-warning alert-dismissible fade show" role="alert">
		            <strong>Advertencia!</strong> El balon no se puede repetir
		            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		              <span aria-hidden="true">&times;</span>
		            </button>
		        </div>
	    	`);
	    	return false;
	    }
	}
	return true;
}