function checkBalonALL() {
    $("#tblBalonSELECT > tbody > tr input:checkbox:enabled").prop('checked', $('#checkBalonALL').prop("checked"));
}
function prestamoBalon() {
	if (verificarListaBalon()) {
		var trBalonSELECT = '';
		for (var i = 0; i < $("#tblBalonSELECT > tbody > tr").length; i++) {
			if($('#checkBalon'+i).is(":checked")) {
				trBalonSELECT += `
					<tr>
						<td>${$('#hdnId_bal'+i).val()}</td>
						<td>${$('#hdnNombre_bal'+i).val()}</td>
						<td>${$('#hdnCantidad_bal'+i).val()}</td>
						<td style="width: 100px"><input id="cantidad_balpre${i}" name="cantidad_balpre${i}" class="form-control" type="number" min="1" max="${$('#hdnCantidad_bal'+i).val()}" required></td>
						<input id="id_bal${i}" name="id_bal${i}" type="hidden" value="${$('#hdnId_bal'+i).val()}">
					</tr>
				`;
			}
		}
		$('#tblExportarBalon > tbody').html(trBalonSELECT);
		$('#mdlExportarBalon').modal('show');
	}
}
function verificarListaBalon() {
	if ($("#tblBalonSELECT > tbody > tr input:checkbox[name=checkBalon]:checked").length <= 0) {
		$('#mdlExportarBalon').modal('hide');
		$('#mensajeBalon').html('<div class="alert alert-warning" role="alert">'+
	    'No hay balones que enviar!'+
	    '</div>');
	    setTimeout(function() {$('#mensajeBalon').html('')},4000);
	    return false;
	}
	return true;
}
function mdlMostrarPrestamo(id_pre) {
	var data = JSON.stringify({'id_pre' : id_pre});
	__ajax('../controllers/prestamoController.php?op=3','POST','JSON',{'data' : data})
	.done(function(info) {
		if (info.STATUS == 'OK') {
			$('#txtNombres_cli').val(info.DATA[0].nombres_cli);
			$('#txtNombres_per').val(info.DATA[0].nombres_per);
			$('#txaMotivo_pre').val(info.DATA[0].motivo_pre);
			$('#fecha_pre').text(info.DATA[0].fecha_pre);
			$('#fecreg_pre').text(info.DATA[0].fecreg_pre);
			var trbalones = ``;
			for (var i in info.DATA[0]['balones']) {
				trbalones += `
					<tr>
						<td class="text-center">
				`;
				if (info.DATA[0]['balones'][i]['estado_balpre'] == 1) {
				trbalones += `
							<button onclick="balon_prestamoEND(${info.DATA[0]['balones'][i]['id_balpre']},${id_pre})" class="btn btn-outline-secondary btn btn-sm">
								<span class="fas fa-hourglass-end"></span>
							</button>
				`;
				}
				trbalones += `
						</td>
						<td class="text-center">${info.DATA[0]['balones'][i]['id_bal']}</td>
						<td>${info.DATA[0]['balones'][i]['nombre_bal']}</td>
						<td class="text-center">${info.DATA[0]['balones'][i]['tipo_bal']}</td>
						<td class="text-center">${info.DATA[0]['balones'][i]['marca_bal']}</td>
						<td class="text-center">${info.DATA[0]['balones'][i]['cantidad_balpre']}</td>
						<td class="text-center">${info.DATA[0]['balones'][i]['fecini_balpre']}</td>
						<td class="text-center">${info.DATA[0]['balones'][i]['fecfin_balpre']}</td>
				`;
				if (info.DATA[0]['balones'][i]['estado_balpre'] == 1) {
					trbalones += `
						<td class="text-center text-success">EN USO</td>
					`;
				} else {
					trbalones += `
						<td class="text-center text-danger">TERMINADO</td>
					`;
				}
				trbalones += `<td class="text-center">${info.DATA[0]['balones'][i]['razsoc_prov']}</td>
					</tr>
				`;
			}
			$('#tblBalones > tbody').html(trbalones);
			$('#mdlMostrarPrestamo').modal('show');
		} else {
			$('#mensajePrestamo >').remove();
			$('#mensajePrestamo').append(`
	            <div class="alert alert-warning alert-dismissible fade show" role="alert">
				  <strong>OH NO!</strong> Ocurrió un error al cargar los datos
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>`);
			setTimeout(function() {$('#mensajePrestamo').html('')},5000);
		}
	});
}
function mdlMostrarPrestamoINSERT(id_balpre,id_bal,nombre_bal) {
	__ajax('../controllers/prestamoController.php?op=4','POST','JSON',{'id_balpre' : id_balpre})
	.done(function(data) {
		if (data.STATUS == 'OK') {
			$('#id_balpre').val(id_balpre);
			$('#spnNombre_bal').text(nombre_bal);
			var row = '';
			for (var i=0;i<data.ID;i++) {
				if (data.DATA[i]) {
					row += `
						<tr>
							<td>${parseInt(i)+1}</td>
							<td>${data.DATA[i].codbar_balxu}</td>
							<td>${data.DATA[i].ingreso_balxupre}</td>`;
					if (data.DATA[i].salida_balxupre == null) {
						row += `<td></td>`;
					} else {
						row += `<td>${data.DATA[i].salida_balxupre}</td>`;
					}
					if (data.DATA[i].estado_balxupre == 1) {
					row += `
							<td>Continua</td>`;
					}
					if (data.DATA[i].estado_balxupre == 2) {
					row += `
							<td>Retirado</td>`;
					}
					row += `<td><button class="btn btn-sm btn-outline-danger"><span class="fas fa-trash-alt"></span></button></td>
						<input type="hidden" id="id_balxu${i}" class="id_balxu" value="${data.DATA[i].id_balxu}">
					</tr>`;
				} else {
					balonxuSELECT(i,id_bal);
					row += `
						<tr>
							<td>${parseInt(i)+1}</td>
							<td>
								<select id="id_balxu${i}" class="id_balxu form-control"></select>
							</td>
							<td></td>
							<td></td>
							<td>Vacio</td>
							<td></td>
						</tr>
					`;
				}
			}
			$('#tblBalonxu_prestamo > tbody').html(row);
			modalShow('mdlMostrarPrestamoDetalle');
		}
	});
}
function mdlMostrarPrestamoDetalle(id_balpre,id_bal,nombre_bal) {
	__ajax('../controllers/prestamoController.php?op=4','POST','JSON',{'id_balpre' : id_balpre})
	.done(function(data) {
		if (data.STATUS == 'OK') {
			$('#id_balpre').val(id_balpre);
			$('#spnNombre_bal').text(nombre_bal);
			var row = '';
			for (var i=0;i<data.DATA.length;i++) {
				row += `
					<tr>
						<td>${parseInt(i)+1}</td>
						<td>${data.DATA[i].codbar_balxu}</td>
						<td>${data.DATA[i].ingreso_balxupre}</td>`;
				if (data.DATA[i].salida_balxupre == null) {
					row += `<td></td>`;
				} else {
					row += `<td>${data.DATA[i].salida_balxupre}</td>`;
				}
				if (data.DATA[i].estado_balxupre == 1) {
				row += `
						<td>Continua</td>`;
				}
				if (data.DATA[i].estado_balxupre == 2) {
				row += `
						<td>Retirado</td>`;
				}
				row += `</tr>`;
			}
			$('#tblBalonxu_prestamo > tbody').html(row);
			modalShow('mdlMostrarPrestamoDetalle');
		}
	});
}
function balonxuSELECT(i,id_bal) {
	__ajax('../controllers/prestamoController.php?op=8','POST','JSON',{'id_bal' : id_bal})
	.done(function(data) {
		if (data.STATUS == 'OK') {
			var row = '';
			for (var j in data.DATA) {
				row += `<option value="${data.DATA[j].id_balxu}">${data.DATA[j].codbar_balxu}</option>`;
			}
			$('#id_balxu'+i).html(row);
		}
	})
}
function accionCHANGE(cantidad) {
	if ($('#sltaccion').val() == 1) {
		$('#editada_balpre').removeAttr('max');
		$('#editada_balpre').attr('max',''+cantidad);
		$('#editada_balpre').removeAttr('onkeyup');
		$('#editada_balpre').attr('onkeyup',`reducircantidad(${cantidad})`);
		reducircantidad(cantidad);
	}
	if ($('#sltaccion').val() == 2) {
		$('#editada_balpre').removeAttr('max');
		$('#editada_balpre').attr('max',''+$('#cantidad_bal').val());
		$('#editada_balpre').removeAttr('onkeyup');
		$('#editada_balpre').attr('onkeyup',`aumentarcantidad(${cantidad})`);
		aumentarcantidad(cantidad);
	}
}
function reducircantidad(cantidad) {
	var editada_balpre = $('#editada_balpre').val();
	var total_balpre = parseInt(cantidad) - parseInt('0'+editada_balpre);
	$('#total_balpre').val(total_balpre);
}
function aumentarcantidad(cantidad) {
	var editada_balpre = $('#editada_balpre').val();
	var total_balpre = parseInt(cantidad) + parseInt('0'+editada_balpre);
	$('#total_balpre').val(total_balpre);
}
function balon_prestamoEND(id_balpre,id_pre,nombre_bal) {
	var data = JSON.stringify({'id_balpre' : id_balpre,'id_pre' : id_pre});
	__ajax('../controllers/prestamoController.php?op=4','POST','JSON',{'data' : data})
	.done(function(info) {
		if (info.STATUS == 'OK') {
			$('#mensajePrestamo >').remove();
			$('#mensajePrestamo').append(`
				<div class="alert alert-success alert-dismissible fade show" role="alert">
				  <strong>CORRECTO!</strong> Préstamo finalizado con éxito.
				  <button class="btn btn-sm btn-outline-light" style="float: right;" onclick="ajaxSimple(\'content\',\'../controllers/prestamoController.php\',1)"><span class="fas -fa-sync-alt"></span>&nbsp;&nbsp;Refrescar</button>
				</div>
			`);
			$('#mdlMostrarPrestamo').modal('hide');
		} else {
			$('#msjModalBalonprestamo >').remove();
			$('#msjModalBalonprestamo').append(`
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
				  <strong>OH NO!</strong> No se pudo finalizar el préstamo.
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>
				`);
			$('#mdlExportarBalon').modal('hide');
			setTimeout(function() {$('#msjModalBalonprestamo').html('')},3000);
		}
	});
}
function balonxu_prestamoINSERT() {
	var id_balxu = '';
	if (verificarbalones() === true) {
		var id_balpre = $('#id_balpre').val();
		$('#btnFactura').removeAttr('disabled');
		$('#btnFactura').attr('disabled','true');
		$('#btnFactura').text('Cargando Factura...');
		var listBalxu = [];
		var nfilas = $('#tblBalonxu_prestamo > tbody > tr').length;
		for (var i = 0; i < nfilas; i++) {
			if ($(`select[id='id_balxu${i}']`).length) {
				listBalxu.push({
					'id_balxu': $('#id_balxu'+i).val()
				});
			}
		}
		var cabecera = {
			'id_balpre': id_balpre,
			'listBalxu': listBalxu
		}
	    var data = JSON.stringify(cabecera);
		console.log(data)
		__ajax('../controllers/prestamoController.php?op=9','POST','JSON',{'data' : data})
		.done(function(info) {
			if (info.STATUS == 'OK') {
				$('#msjBalonprestamo >').remove();
				$('#msjBalonprestamo').append(`
					<div class="alert alert-success alert-dismissible fade show" role="alert">
					  <strong>CORRECTO!</strong> Registro de balones correcto
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
				`);
				$('#mdlMostrarPrestamoDetalle').modal('hide');
			} else {
				$('#msjBalonprestamo >').remove();
				$('#msjBalonprestamo').append(`
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
					  <strong>OH NO!</strong> No puedes registrar el balon al prestamo.
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
					`);
				$('#mdlMostrarPrestamoDetalle').modal('hide');
			}
		});
	}
}
function verificarbalones() {
    flat = false;
	var nfilas = $('#tblBalonxu_prestamo > tbody > tr').length;
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