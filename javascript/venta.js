function listBalonVentaAdd(id_bal) {
	var count = 0;
	$('#tblVentaProducto > tbody > tr').each(function(){
		count++;
	});
	__ajax('../controllers/ventasController.php?op=2','POST','JSON',{'id_bal' : id_bal})
	.done(function(info) {
		if (info.STATUS == 'OK') {
			$('#divBodyBalon1').css('display','none');
			$('#divBodyBalon2').css('display','');
			var row = `
				<tr>
					<td>
						<div class="input-group" style="min-width: 80px">
			                <div class="input-group-prepend">
			                    <button id="boton${count+1}" onclick="borrarlineaProducto(${count+1})" type="button" class="boton btn btn-danger"><span class="fas fa-trash-alt"></span></button>
			                </div>
		                  	<input id="item${count+1}" value="${count+1}" type="text" class="item form-control">
		                </div>
					</td>
					<td>
						<input id="descripcion_balven${count+1}" name="descripcion_balven${count+1}" class="descripcion_balven form-control" type="text" value="${info.DATA[0].nombre_bal}" style="min-width: 250px;" readonly>
					</td>
					<td><input id="cantidad_balven${count+1}" name="cantidad_balven${count+1}" onkeyup="calcularlinea(${count+1})" onchange="calcularlinea(${count+1})" class="cantidad_balven form-control" type="number" min="1" max="${info.DATA[0].cantidad_bal}" value="1" style="min-width: 75px;" required></td>
					<td><input id="descuento_balven${count+1}" name="descuento_balven${count+1}" onkeyup="calcularlinea(${count+1})" onchange="calcularlinea(${count+1})" class="descuento_balven form-control" type="number" step="0.01" max="1" value="0.00" style="min-width: 75px;"></td>
					<td><input id="igv_balven${count+1}" name="igv_balven${count+1}" class="igv_balven form-control text-center" style="min-width: 75px;" readonly></td>
					<td><input id="valor_unitario${count+1}" name="valor_unitario${count+1}" class="valor_unitario form-control text-center" style="min-width: 75px;" readonly></td>
					<td><input id="precio_unitario${count+1}" name="precio_unitario${count+1}" class="precio_unitario form-control text-center" value="${info.DATA[0].precio_bal}" style="min-width: 75px;" readonly></td>
					<td><input id="subtotal${count+1}" name="subtotal${count+1}" class="subtotal form-control text-center" style="min-width: 75px" readonly></td>
					<td><input id="total${count+1}" name="total${count+1}" class="total form-control text-right" style="min-width: 100px" readonly></td>
					<input id="id_bal${count+1}" name="id_bal${count+1}" type="hidden" value="${info.DATA[0].id_bal}">
				</tr>
			`;
			$("#tblVentaProducto > tbody").append(row);
			verificarLinea(count+1);
			calcularlinea(count+1);
			$('#btnProcesarVenta').removeAttr('disabled');
			$('#btnProcesarVentaAnonima').removeAttr('disabled');
			$('#id_bal > ').remove();
		}
	})
}
function verificarLinea(item) {
    count=0;
    flat = false;
    $('#tblVentaProducto > tbody > tr').each(function(){
      count++;
    });
	for (var i = 0; i < count; i++) {
        if($("#id_bal"+i).val() == $("#id_bal"+item).val()  && item != i){
            flat = true;
        }
    }
    if(flat){
    	$('#msjVentaPrducto').html(`
    		<div class="alert alert-warning alert-dismissible fade show" role="alert">
	            <strong>Advertencia!</strong> El producto ya ha sido escogido.
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	        </div>
    	`);
    	borrarlineaProducto(item);
    }
}
function borrarlineaProducto(item){
    count = 0;
    $('#tblVentaProducto > tbody > tr').each(function(){
      count++;
    });
    //console.log("numero:"+numero+":");
    if (item == count) {
        document.getElementById("tblVentaProducto").deleteRow(item);
        if (count == 1) {
			$('#divBodyBalon1').css('display','');
			$('#divBodyBalon2').css('display','none');
			$('#btnProcesarVenta').attr('disabled','true');
			$('#btnProcesarVentaAnonima').attr('disabled','true');
        }
    } else{
    	$('#msjVentaPrducto').html(`
    		<div class="alert alert-warning alert-dismissible fade show" role="alert">
	            <strong>Advertencia!</strong> No puede eliminar este Item - eliminar de abajo para arriba.
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	        </div>
    	`);
    }
    var item= $(this).parent().parent().parent().parent().find('.item').val();
    calcularlinea(item);
}
function calcularlinea(item) {
	var descuento_balven = parseFloat('0'+$('#descuento_balven'+item).val());

	var precio_unitario = parseFloat('0'+$('#precio_unitario'+item).val());

	var cantidad_balven = parseInt('0'+$('#cantidad_balven'+item).val());

	var subtotal = parseFloat(parseFloat(precio_unitario)-parseFloat(descuento_balven)).toFixed(2);

	var valor_unitario = parseFloat(parseFloat(subtotal)/1.18).toFixed(2);

	var total = parseFloat(parseFloat(parseFloat(precio_unitario)*parseFloat(cantidad_balven))-parseFloat(descuento_balven)).toFixed(2);

	var igv_balpre = parseFloat(parseFloat(parseFloat(total)/1.18)*0.18).toFixed(2);
	
	$('#igv_balven'+item).val(igv_balpre);
	$('#valor_unitario'+item).val(valor_unitario);
	$('#subtotal'+item).val(subtotal);
	$('#total'+item).val(total);
	calculartotal();
}
function calculartotal() {
    var count = 0;
	$('#tblVentaProducto > tbody > tr').each(function(){
     	count++;      
    });
    var descuento = 0;
    var txtivgtotal = 0;
    var txtgrabada = 0;
    var txttotal = 0;
    for (var i = 0; i < count; i++) {
        var descuento_balven = parseFloat($("#descuento_balven"+(i+1)).val());
        var subtotal = parseFloat($("#subtotal"+(i+1)).val());
        var total = parseFloat($("#total"+(i+1)).val());
        var igv_balven = parseFloat($("#igv_balven"+(i+1)).val());
        descuento += descuento_balven;
        txtivgtotal += igv_balven;
        txtgrabada += subtotal;
        txttotal += total;
    }
    $('#dscto_ven').val(parseFloat(txtivgtotal).toFixed(2));
    $('#gravado_ven').val(parseFloat(parseFloat(txttotal)/1.18).toFixed(2));
    $('#igv_ven').val(parseFloat(parseFloat(txttotal)*9/59).toFixed(2));
    $('#total_ven').val(parseFloat(txttotal).toFixed(2));
    $('#spnTotal_ven').text(parseFloat(txttotal).toFixed(2));
}
$("#divTotal").hover(function(){
    $("#divTotales").css("display", "");
    }, function(){
    $("#divTotales").css("display", "");
});
function documentoCHANGE(valor) {
	__ajax('../controllers/ventasController.php?op=3','POST','JSON',{'id_cli' : valor})
	.done(function(info) {
		if (info.STATUS == 'OK') {
			if( !$('#ckxProforma').prop('checked') ) {
				if (info.DATA[0].tipdoc_cli == 1) {
					$('#txttipocomprobante').val('BOLETA DE VENTA ELECTRONICA');
					$('#serie').val('BP01');
					$('#tipdoc_cli').val('1');
				}
				if (info.DATA[0].tipdoc_cli == 6) {
					$('#txttipocomprobante').val('FACTURA DE VENTA ELECTRONICA');
					$('#serie').val('FP01');
					$('#tipdoc_cli').val('6');
				}
			}
			$('#tipdoc_cli').val(info.DATA[0].tipdoc_cli);
		}
	});
}
function ventaAnonima() {
	var frmProcesarVenta = document.getElementById('frmProcesarVenta');
	if (frmProcesarVenta.checkValidity()) {
	    var opcion = false;
	    if ($('#ckxCredito').is(':checked') == false) {
	      opcion = true;
	    } else if (parseInt($('#fecfin').val()) >= 60) {
	      modalShow('mdlCredito60');
	    } else {
	      opcion = true;
	    }
	    if (opcion == true) {
	    $('#btnProcesarVentaAnonima').removeAttr('disabled');
	    $('#btnProcesarVentaAnonima').attr('disabled','true');
	    $('#btnProcesarVentaAnonima').text('CARGANDO COMPROBANTE...');
	    //alert($('#ckxProforma:checked').val());
	    var dataform = new FormData(frmProcesarVenta);
	    dataform.append('nfilas', $('#tblVentaProducto > tbody > tr').length);
	    dataform.append('nguias', $('#divgremision .divguiarow').length);
	    fetch('../controllers/ventasController.php?op=10',{
	        method: 'POST',
	        body: dataform
	    })
	    .then(res => res.json())
	    .then(data => {
	      var msjVentaPrductoGeneral = document.getElementById('msjVentaPrductoGeneral');
	      if (data.STATUS === 'OK') {
	        msjVentaPrductoGeneral.innerHTML = `
	          <div class="alert alert-success alert-dismissible fade show" role="alert">
	            ${data.ERROR}
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	          </div>
	        `;
	        if ($('#ckxProforma').prop('checked')) {
	          frmProcesarVenta_CLEAN();
	          $('#btnProcesarVentaAnonima').removeAttr('disabled');
	          $('#btnProcesarVentaAnonima').text('PROCESAR');
	        } else {
	          $('#btnProcesarVentaAnonima').text('REGISTRANDO DATOS...');
	          dataform.append('numero_comprobante', `${data.DATA.numero}`);
	          dataform.append('pdf_base64', `${data.DATA.pdf_base64}`);
	          fetch('../controllers/ventasController.php?op=5',{
	              method: 'POST',
	              body: dataform
	          })
	          .then(res => res.json())
	          .then(data => {
	            if (data.STATUS === 'OK') {
	              msjVentaPrductoGeneral.innerHTML = `
	                <div class="alert alert-success alert-dismissible fade show" role="alert">
	                  <strong>CORRECTO!!!</strong> Registro Guardado con exito!
	                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                  </button>
	                </div>
	              `;
	              frmProcesarVenta_CLEAN();
	              $('#btnProcesarVentaAnonima').removeAttr('disabled');
	              $('#btnProcesarVentaAnonima').text('PROCESAR');
	            } else {
	              msjVentaPrductoGeneral.innerHTML = `
	                <div class="alert alert-success alert-dismissible fade show" role="alert">
	                  <strong>ERROR!!!</strong> No se pudo registrar la venta!
	                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                  </button>
	                </div>
	              `;
	              $('#btnProcesarVentaAnonima').text('ERROR');
	            }
	          })
	        }
	      } else {
	        msjVentaPrductoGeneral.innerHTML = `
	          <div class="alert alert-danger alert-dismissible fade show" role="alert">
	            ${data.ERROR}
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	          </div>
	        `;
	      }
	    })
	    }
	} else {
      var msjVentaPrductoGeneral = document.getElementById('msjVentaPrductoGeneral');
        msjVentaPrductoGeneral.innerHTML = `
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>ALERTA! </strong> Faltan completar campos o los campos digitados estan erroneos.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        `;
	}
}
function frmProcesarVenta_CLEAN() {
	$("#id_cli > ").remove();
	$('#tblVentaProducto > tbody >').remove();
	$('#divBodyBalon1').css('display','');
	$('#divBodyBalon2').css('display','none');
	$('#btnProcesarVenta').attr('disabled','true');
	$('#btnProcesarVentaAnonima').attr('disabled','true');
	$("#id_bal > ").remove();
	$("#spnTotal_ven").val('0.00');
}
function guiaAdd() {
    count=0;
	$('#divgremision > .divguia > .row').each(function() {
      count++;
    });
    if (count <= 0) {
		$('#divgremision .divguia').append(`
			<div class="row mb-2 divguiarow" id="divguia${count+1}">
				<div class="col-5">
					<input class="form-control" type="text" value="T001" readonly>
				</div>
				<div class="col-6">
					<input id="correlativo_gui${count+1}" name="correlativo_gui${count+1}" class="form-control" type="number" min="1" max="99999" placeholder="Numero" required>
				</div>
				<div class="col-1">
					<span class="fas fa-trash-alt text-danger" onclick="borrarlinea(${count+1})" style="padding-top: 10px;"></span>
				</div>
			</div>
		`);
    }
}
function borrarlinea(item){
    count = 0;
    $('#divgremision > .divguia > .row').each(function(){
      count++;
    });
    if (item == count) {
		$('#divgremision .divguia #divguia'+item).remove();
    }
}
function confirmarAdmin(event) {
	event.preventDefault();
	var usuario_per = $('#usuario_per').val();
	var clave_per = $('#clave_per').val();
	__ajax('../controllers/loginController.php?op=3','POST','JSON',{'usuario_per' : usuario_per,'clave_per' : clave_per})
	.done(function(info) {
		if (info == 'OK') {
			var frmValidarAdmin = document.getElementById('frmValidarAdmin');
			frmValidarAdmin.reset();
			modalHide('mdlCredito60');
		    $('#btnProcesarVenta').removeAttr('disabled');
		    $('#btnProcesarVenta').attr('disabled','true');
		    $('#btnProcesarVenta').text('CARGANDO COMPROBANTE...');
			var frmProcesarVenta = document.getElementById('frmProcesarVenta');
			var dataform = new FormData(frmProcesarVenta);
		    dataform.append('nfilas', $('#tblVentaProducto > tbody > tr').length);
		    dataform.append('nguias', $('#divgremision .divguiarow').length);
		    fetch('../controllers/ventasController.php?op=4',{
		        method: 'POST',
		        body: dataform
		    })
		    .then(res => res.json())
		    .then(data => {
		      var msjVentaPrductoGeneral = document.getElementById('msjVentaPrductoGeneral');
		      if (data.STATUS === 'OK') {
		        msjVentaPrductoGeneral.innerHTML = `
		          <div class="alert alert-success alert-dismissible fade show" role="alert">
		            ${data.ERROR}
		            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		              <span aria-hidden="true">&times;</span>
		            </button>
		          </div>
		        `;
		        if ($('#ckxProforma').prop('checked')) {
		          frmProcesarVenta_CLEAN();
		          $('#btnProcesarVenta').removeAttr('disabled');
		          $('#btnProcesarVenta').text('PROCESAR');
		        } else {
		          $('#btnProcesarVenta').text('REGISTRANDO DATOS...');
		          dataform.append('numero_comprobante', `${data.DATA.numero}`);
		          dataform.append('pdf_base64', `${data.DATA.pdf_base64}`);
		          fetch('../controllers/ventasController.php?op=5',{
		              method: 'POST',
		              body: dataform
		          })
		          .then(res => res.json())
		          .then(data => {
		            if (data.STATUS === 'OK') {
		              msjVentaPrductoGeneral.innerHTML = `
		                <div class="alert alert-success alert-dismissible fade show" role="alert">
		                  <strong>CORRECTO!!!</strong> Registro Guardado con exito!
		                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                    <span aria-hidden="true">&times;</span>
		                  </button>
		                </div>
		              `;
		              frmProcesarVenta_CLEAN();
		              $('#btnProcesarVenta').removeAttr('disabled');
		              $('#btnProcesarVenta').text('PROCESAR');
		            } else {
		              msjVentaPrductoGeneral.innerHTML = `
		                <div class="alert alert-success alert-dismissible fade show" role="alert">
		                  <strong>ERROR!!!</strong> No se pudo registrar la venta!
		                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                    <span aria-hidden="true">&times;</span>
		                  </button>
		                </div>
		              `;
		              $('#btnProcesarVenta').text('ERROR');
		            }
		          })
		        }
		      } else {
		        msjVentaPrductoGeneral.innerHTML = `
		          <div class="alert alert-danger alert-dismissible fade show" role="alert">
		            ${data.ERROR}
		            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		              <span aria-hidden="true">&times;</span>
		            </button>
		          </div>
		        `;
		      }
		    })
		} else {
	        var msjValidarAdmin = document.getElementById('msjValidarAdmin');
		    msjValidarAdmin.innerHTML = `
	          <div class="alert alert-danger alert-dismissible fade show" role="alert">
	            <strong>ERROR</strong> Usuario y clave incorrectos
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	          </div>
	        `;
		}
	})
}
function opcionesComprobanteOPEN(id_ven,stipo_per) {
	__ajax('../controllers/comprobantesController.php?op=7','POST','JSON',{'id_ven' : id_ven})
	.done(function(info) {
		if (info.STATUS == 'OK') {
			var modal = '';
			modal += `<div class="row">
				          <div class="col">
				            <div class="form-group">
				              <div class="form-control text-center" style="height: 100px;">
			`;
			if (info.DATA[0].tipo_comprobante == 1){
				modal += `<h5><strong>FACTURA DE VENTA ELECTRÓNICA</strong></h5>`;
			}
			if (info.DATA[0].tipo_comprobante == 3){
				modal += `<h5><strong>BOLETA DE VENTA ELECTRÓNICA</strong></h5>`;
			}
			if (info.DATA[0].tipo_comprobante == 7){
				modal += `<h5><strong>NOTA DE CRÉDITO ELECTRÓNICA</strong></h5>`;
			}
				        modal += `<h5><span>${info.DATA[0].serie_ven}</span>-<span>${info.DATA[0].correlativo_ven}</span></h5>
				                <h5><strong>S/ ${info.DATA[0].total_ven}</strong></h5>
				              </div>
				            </div>
				          </div>
				        </div>
				        <div class="row">
				          <div class="col">
				            <div class="form-group">
				              <div class="form-control" style="height: 90px;">
				                <h5><strong>CLIENTE</strong></h5>
				                <h6>${info.DATA[0].nombres_cli}</h6>`;
			if (info.DATA[0].tipdoc_cli == 1){
				modal += `<h6>RUC ${info.DATA[0].numdoc_cli}</h6>`;
			}
			if (info.DATA[0].tipdoc_cli == 6){
				modal += `<h6>DNI ${info.DATA[0].numdoc_cli}</h6>`;
			}
				    modal += `</div>
				            </div>
				          </div>
				        </div>
				        <div class="row">
				          <div class="col">
				            <div class="form-group">
				              <div class="form-control" style="height: 90px;">
				                <h5><strong>USUARIO</strong></h5>
				                <h6>ERP</h6>
				                <h6>${info.DATA[0].nfecini_ven}</h6>
				              </div>
				            </div>
				          </div>
				        </div>
				        <div class="row">
				          <div class="col">
				            <div class="form-group">
				              <div class="form-control" style="height: 70px;">
				                <h5><strong>ESTADO SUNAT</strong></h5>`;
			if (info.DATA[0].tipo_comprobante == 1){
				modal += `<h6>ACEPTADO</h6>`;
			}
			if (info.DATA[0].tipo_comprobante == 3){
				modal += `<h6>ENVIADO EN RESUMEN DIARIO</h6>`;
			}
			if (info.DATA[0].tipo_comprobante == 7){
				modal += `<h6>PENDIENTE DE ENVIO</h6>`;
			}
				    modal += `</div>
				            </div>
				          </div>
				        </div>`;
			if (info.DATA[0].tipo_comprobante == 7){
				modal += `<div class="row">
				          <div class="col">
				            <div class="form-group">
				              <div class="form-control" style="height: 70px;">
				                <h5><strong>DOCUMENTO AFECTADO</strong></h5>
				                <h6><span>${info.DATA[0].serie_docafec}</span>-<span>${info.DATA[0].numero_docafec}</span></h6>
				              </div>
				            </div>
				          </div>
				        </div>`;
			}
			modal += `<div class="row">
				          <div class="col">
				            <div class="form-group">
				              <a class="btn btn-primary btn-block" href="../dist/comprobantes/${info.DATA[0].serie_ven}-${info.DATA[0].correlativo_ven}.pdf" target="_BLANK">VISUALIZAR PDF</a>
				            </div>
				          </div>`;
			if (info.DATA[0].estado_ven != 1 && info.DATA[0].estado_ven != 3 && info.DATA[0].tipo_comprobante != 7 && info.DATA[0].tipo_comprobante != 8) {
				if (stipo_per == 1) {
				modal += `<div class="col">
				            <div class="form-group">
				              <button id="btnNotacreditoGENERATE" type="button" class="btn btn-primary btn-block" onclick="notacreditoGENERATE(${id_ven})">NOTA DE CREDITO</button>
				            </div>
				          </div>`;
				}
				var fechaactual = new Date();
				var fechaactual = sumarDias(fechaactual,-1);
				var fechalimit = transformFecha(fechaactual);
				if (stipo_per == 2 && info.DATA[0].fecini_ven >= fechalimit) {
				modal += `<div class="col">
				            <div class="form-group">
				              <button id="btnNotacreditoGENERATE" type="button" class="btn btn-primary btn-block" onclick="notacreditoGENERATE(${id_ven})">NOTA DE CREDITO</button>
				            </div>
				          </div>`;
				}
			} 
				modal += `</div>`;
			$('#mdlbodyVerOpcionesVentas').html(modal);
			modalShow('mdlVerOpcionesVentas');
		}
	});
}

function opcionesPedidosOPEN(id_ped,stipo_per) {
	__ajax('../controllers/comprobantesController.php?op=15','POST','JSON',{'id_ped' : id_ped})
	.done(function(info) {
		if (info.STATUS == 'OK') {
			var modal = '';
			modal += `<div class="row">
				          <div class="col">
				            <div class="form-group">
				              <div class="form-control text-center" style="height: 100px;">
				              	<h5><strong>PEDIDO</strong></h5>
								<h5><span>${info.DATA[0].serie}</span></h5>
				                <h5><strong>S/ ${info.DATA[0].total_ped}</strong></h5>
				              </div>
				            </div>
				          </div>
				        </div>
				        <div class="row">
				          <div class="col">
				            <div class="form-group">
				              <div class="form-control" style="height: 90px;">
				                <h5><strong>CLIENTE</strong></h5>
				                <h6>${info.DATA[0].nombres_cli}</h6>`;
			if (info.DATA[0].tipdoc_cli == 6){
				modal += `<h6>RUC ${info.DATA[0].numdoc_cli}</h6>`;
			}
			if (info.DATA[0].tipdoc_cli == 1){
				modal += `<h6>DNI ${info.DATA[0].numdoc_cli}</h6>`;
			}
				    modal += `</div>
				            </div>
				          </div>
				        </div>
				        <div class="row">
				          <div class="col">
				            <div class="form-group">
				              <div class="form-control" style="height: 90px;">
				                <h5><strong>USUARIO</strong></h5>
				                <h6>INVERSIONES Y MULTISERVICIOS ACN</h6>
				                <h6>${info.DATA[0].nfecini_ped}</h6>
				              </div>
				            </div>
				          </div>
				        </div>
				        <div class="row">
				          <div class="col">
				            <div class="form-group">
				              <a class="btn btn-primary btn-block" href="../dist/proformas/proforma${info.DATA[0].id_pro}.pdf" target="_BLANK">VISUALIZAR PDF</a>
				            </div>
				          </div>`;
			if (info.DATA[0].estado_ped == 1 && (stipo_per == 1 || stipo_per == 2 || stipo_per == 3)) {
				modal += `<div class="col">
				            <div class="form-group">
				              <button class="btn btn-primary btn-block" type="button" onclick="ajaxPagina('content','./ventas/ventasPrincipal.php?id_ped=${info.DATA[0].id_ped}')">CONVERTIR A CPE</button>
				            </div>
				          </div>`;
			}
			modal += `</div>`;
			if (info.DATA[0].estado_ped == 1) {
				if (stipo_per == 1) {
				modal += `<div class="row">
						  <div class="col">
				            <div class="form-group">
				              <button class="btn btn-danger btn-block" type="button" onclick="ajaxCompuesto('content','../controllers/comprobantesController.php',17,'id_ped=${info.DATA[0].id_ped}');modalDestroy()">RECHAZAR</button>
				            </div>
				          </div>
				        </div>`;
				}
				var fechaactual = new Date();
				var fechaactual = sumarDias(fechaactual,-1);
				var fechalimit = transformFecha(fechaactual);
				if (stipo_per == 2 && info.DATA[0].fecini_ped >= fechalimit) {
				modal += `<div class="row">
						  <div class="col">
				            <div class="form-group">
				              <button class="btn btn-danger btn-block" type="button" onclick="ajaxCompuesto('content','../controllers/comprobantesController.php',17,'id_ped=${info.DATA[0].id_ped}');modalDestroy()">RECHAZAR</button>
				            </div>
				          </div>
				        </div>`;
				}
			}
			$('#mdlbodyVerOpcionesProforma').html(modal);
			modalShow('mdlVerOpcionesProforma');
		}
	});
}

function opcionesProformaOPEN(id_pro,stipo_per) {
	__ajax('../controllers/comprobantesController.php?op=9','POST','JSON',{'id_pro' : id_pro})
	.done(function(info) {
		if (info.STATUS == 'OK') {
			var modal = '';
			modal += `<div class="row">
				          <div class="col">
				            <div class="form-group">
				              <div class="form-control text-center" style="height: 100px;">
				              	<h5><strong>PROFORMA</strong></h5>
								<h5><span>${info.DATA[0].serie_ven}</span>-<span>${info.DATA[0].correlativo_ven}</span></h5>
				                <h5><strong>S/ ${info.DATA[0].total_ven}</strong></h5>
				              </div>
				            </div>
				          </div>
				        </div>
				        <div class="row">
				          <div class="col">
				            <div class="form-group">
				              <div class="form-control" style="height: 90px;">
				                <h5><strong>CLIENTE</strong></h5>
				                <h6>${info.DATA[0].nombres_cli}</h6>`;
			if (info.DATA[0].tipdoc_cli == 6){
				modal += `<h6>RUC ${info.DATA[0].numdoc_cli}</h6>`;
			}
			if (info.DATA[0].tipdoc_cli == 1){
				modal += `<h6>DNI ${info.DATA[0].numdoc_cli}</h6>`;
			}
				    modal += `</div>
				            </div>
				          </div>
				        </div>
				        <div class="row">
				          <div class="col">
				            <div class="form-group">
				              <div class="form-control" style="height: 90px;">
				                <h5><strong>USUARIO</strong></h5>
				                <h6>INVERSIONES Y MULTISERVICIOS ACN</h6>
				                <h6>${info.DATA[0].nfecini_ven}</h6>
				              </div>
				            </div>
				          </div>
				        </div>
				        <div class="row">
				          <div class="col">
				            <div class="form-group">
				              <a class="btn btn-primary btn-block" href="../dist/proformas/proforma${info.DATA[0].id_pro}.pdf" target="_BLANK">VISUALIZAR PDF</a>
				            </div>
				          </div>`;
			if (info.DATA[0].estado_pro == 1 && (stipo_per == 1 || stipo_per == 2 || stipo_per == 3)) {
				modal += `<div class="col">
				            <div class="form-group">
				              <button class="btn btn-primary btn-block" type="button" onclick="ajaxPagina('content','./ventas/ventasPrincipal.php?id_pro=${info.DATA[0].id_pro}')">CONVERTIR A CPE</button>
				            </div>
				          </div>`;
			}
			modal += `</div>`;
			if (info.DATA[0].estado_pro == 1) {
				if (stipo_per == 1) {
				modal += `<div class="row">
						  <div class="col">
				            <div class="form-group">
				              <button class="btn btn-danger btn-block" type="button" onclick="ajaxCompuesto('content','../controllers/comprobantesController.php',12,'id_pro=${info.DATA[0].id_pro}');modalDestroy()">ANULAR</button>
				            </div>
				          </div>
				        </div>`;
				}
				var fechaactual = new Date();
				var fechaactual = sumarDias(fechaactual,-1);
				var fechalimit = transformFecha(fechaactual);
				if (stipo_per == 2 && info.DATA[0].fecini_ven >= fechalimit) {
				modal += `<div class="row">
						  <div class="col">
				            <div class="form-group">
				              <button class="btn btn-danger btn-block" type="button" onclick="ajaxCompuesto('content','../controllers/comprobantesController.php',12,'id_pro=${info.DATA[0].id_pro}');modalDestroy()">ANULAR</button>
				            </div>
				          </div>
				        </div>`;
				}
			}
			$('#mdlbodyVerOpcionesProforma').html(modal);
			modalShow('mdlVerOpcionesProforma');
		}
	});
}
function cargarDATAVenta(id_pro) {
	__ajax('../controllers/comprobantesController.php?op=11','POST','JSON',{'id_pro' : id_pro})
	.done(function(info) {
		if (info.STATUS == 'OK') {
			$('#id_pro').val(id_pro);
			$('#id_cli').append(`<option value="${info.DATA[0].id_cli}">${info.DATA[0].nombres_cli}</option>`);
			$('#tipdoc_cli').val(info.DATA[0].tipdoc_cli);
			if (info.DATA[0].tipo_comprobante == 1) {
				$('#txttipocomprobante').val('FACTURA DE VENTA ELECTRONICA');
				$('#serie').val('FP01');
			}
			if (info.DATA[0].tipo_comprobante == 3) {
				$('#txttipocomprobante').val('BOLETA DE VENTA ELECTRONICA');
				$('#serie').val('BP01');
			}
			$('#divBodyBalon1').css('display','none');
			$('#divBodyBalon2').css('display','');
			for (var i in info.DATA[0].BALONES) {
				$("#tblVentaProducto > tbody").append(`
					<tr>
						<td>
							<div class="input-group">
				                <div class="input-group-prepend">
				                    <button id="boton${parseInt(i)+1}" onclick="borrarlineaProducto(${parseInt(i)+1})" type="button" class="boton btn btn-danger"><span class="fas fa-trash-alt"></span></button>
				                </div>
			                  	<input id="item${parseInt(i)+1}" value="${parseInt(i)+1}" type="text" class="item form-control">
			                </div>
						</td>
						<td>
							<input id="descripcion_balven${parseInt(i)+1}" name="descripcion_balven${parseInt(i)+1}" class="descripcion_balven form-control" type="text" value="${info.DATA[0].BALONES[i].nombre_bal}" style="min-width: 250px;" readonly>
						</td>
						<td><input id="cantidad_balven${parseInt(i)+1}" name="cantidad_balven${parseInt(i)+1}" onkeyup="calcularlinea(${parseInt(i)+1})" onchange="calcularlinea(${parseInt(i)+1})" class="cantidad_balven form-control" type="number" min="1" max="${info.DATA[0].BALONES[i].cantidad_bal}" value="${parseInt(info.DATA[0].BALONES[i].cantidad_balven)}" required></td>
						<td><input id="descuento_balven${parseInt(i)+1}" name="descuento_balven${parseInt(i)+1}" onkeyup="calcularlinea(${parseInt(i)+1})" onchange="calcularlinea(${parseInt(i)+1})" class="descuento_balven form-control" type="number" step="0.01" max="1" value="${info.DATA[0].BALONES[i].descuento_balven}"></td>
						<td><input id="igv_balven${parseInt(i)+1}" name="igv_balven${parseInt(i)+1}" class="igv_balven form-control" readonly></td>
						<td><input id="valor_unitario${parseInt(i)+1}" name="valor_unitario${parseInt(i)+1}" class="valor_unitario form-control" type="number" readonly></td>
						<td><input id="precio_unitario${parseInt(i)+1}" name="precio_unitario${parseInt(i)+1}" class="precio_unitario form-control" value="${info.DATA[0].BALONES[i].precio_unitario}" readonly></td>
						<td><input id="subtotal${parseInt(i)+1}" name="subtotal${parseInt(i)+1}" class="subtotal form-control" readonly></td>
						<td><input id="total${parseInt(i)+1}" name="total${parseInt(i)+1}" class="total form-control" readonly></td>
						<input id="id_bal${parseInt(i)+1}" name="id_bal${parseInt(i)+1}" type="hidden" value="${info.DATA[0].BALONES[i].id_bal}">
					</tr>
				`);
				calcularlinea(parseInt(i)+1);
			}
			$('#btnProcesarVenta').removeAttr('disabled');
			$('#btnProcesarVentaAnonima').removeAttr('disabled');
			$('#id_bal > ').remove();
		}
	});
}
function cargarDATAPedido(id_ped) {
	__ajax('../controllers/comprobantesController.php?op=16','POST','JSON',{'id_ped' : id_ped})
	.done(function(info) {
		if (info.STATUS == 'OK') {
			$('#id_ped').val(id_ped);
			$('#id_cli').append(`<option value="${info.DATA[0].id_cli}">${info.DATA[0].nombres_cli}</option>`);
			$('#tipdoc_cli').val(info.DATA[0].tipdoc_cli);
			if (info.DATA[0].tipo_comprobante == 1) {
				$('#txttipocomprobante').val('FACTURA DE VENTA ELECTRONICA');
				$('#serie').val('FP01');
			}
			if (info.DATA[0].tipo_comprobante == 3) {
				$('#txttipocomprobante').val('BOLETA DE VENTA ELECTRONICA');
				$('#serie').val('BP01');
			}
			$('#divBodyBalon1').css('display','none');
			$('#divBodyBalon2').css('display','');
			for (var i in info.DATA[0].BALONES) {
				$("#tblVentaProducto > tbody").append(`
					<tr>
						<td>
							<div class="input-group">
				                <div class="input-group-prepend">
				                    <button id="boton${parseInt(i)+1}" onclick="borrarlineaProducto(${parseInt(i)+1})" type="button" class="boton btn btn-danger"><span class="fas fa-trash-alt"></span></button>
				                </div>
			                  	<input id="item${parseInt(i)+1}" value="${parseInt(i)+1}" type="text" class="item form-control">
			                </div>
						</td>
						<td>
							<input id="descripcion_balven${parseInt(i)+1}" name="descripcion_balven${parseInt(i)+1}" class="descripcion_balven form-control" type="text" value="${info.DATA[0].BALONES[i].nombre_bal}" style="min-width: 250px;" readonly>
						</td>
						<td><input id="cantidad_balven${parseInt(i)+1}" name="cantidad_balven${parseInt(i)+1}" onkeyup="calcularlinea(${parseInt(i)+1})" onchange="calcularlinea(${parseInt(i)+1})" class="cantidad_balven form-control" type="number" min="1" max="${info.DATA[0].BALONES[i].cantidad_bal}" value="${parseInt(info.DATA[0].BALONES[i].cantidad_balven)}" required></td>
						<td><input id="descuento_balven${parseInt(i)+1}" name="descuento_balven${parseInt(i)+1}" onkeyup="calcularlinea(${parseInt(i)+1})" onchange="calcularlinea(${parseInt(i)+1})" class="descuento_balven form-control" type="number" step="0.01" max="1" value="${info.DATA[0].BALONES[i].descuento_balven}"></td>
						<td><input id="igv_balven${parseInt(i)+1}" name="igv_balven${parseInt(i)+1}" class="igv_balven form-control" readonly></td>
						<td><input id="valor_unitario${parseInt(i)+1}" name="valor_unitario${parseInt(i)+1}" class="valor_unitario form-control" type="number" readonly></td>
						<td><input id="precio_unitario${parseInt(i)+1}" name="precio_unitario${parseInt(i)+1}" class="precio_unitario form-control" value="${info.DATA[0].BALONES[i].precio_unitario}" readonly></td>
						<td><input id="subtotal${parseInt(i)+1}" name="subtotal${parseInt(i)+1}" class="subtotal form-control" readonly></td>
						<td><input id="total${parseInt(i)+1}" name="total${parseInt(i)+1}" class="total form-control" readonly></td>
						<input id="id_bal${parseInt(i)+1}" name="id_bal${parseInt(i)+1}" type="hidden" value="${info.DATA[0].BALONES[i].id_bal}">
					</tr>
				`);
				calcularlinea(parseInt(i)+1);
			}
			$('#btnProcesarVenta').removeAttr('disabled');
			$('#btnProcesarVentaAnonima').removeAttr('disabled');
			$('#id_bal > ').remove();
		}
	});
}
function notacreditoGENERATE(id_ven) {
    $('#btnNotacreditoGENERATE').removeAttr('disabled');
    $('#btnNotacreditoGENERATE').attr('disabled','true');
    $('#btnNotacreditoGENERATE').text('CARGANDO NOTA...');
	__ajax('../controllers/ventasController.php?op=6','POST','JSON',{'id_ven' : id_ven})
	.done(function(data) {
		if (data.STATUS == 'OK') {
			$('#msjhistorialventas').html(`<div class="alert alert-success alert-dismissible fade show" role="alert">
	            ${data.ERROR}
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	        </div>`);
          	$('#btnNotacreditoGENERATE').text('REGISTRANDO DATOS...');
	        __ajax('../controllers/ventasController.php?op=7','POST','JSON',{'id_ven' : data.DATA.id_ven, 'serie' : `${data.DATA.serie}`, 'numero' : data.DATA.numero, 'pdf_base64' : `${data.DATA.pdf_base64}`})
			.done(function(info) {
				if (info.STATUS == 'OK') {
				    $('#btnNotacreditoGENERATE').removeAttr('disabled');
				    $('#btnNotacreditoGENERATE').text('CORRECTO');
				    modalHide('mdlVerOpcionesVentas');
					$('#msjhistorialventas').html(`<div class="alert alert-success alert-dismissible fade show" role="alert">
	                  	<strong>CORRECTO!!!</strong> Registro Guardado con exito!
	                  	<button class="btn btn-sm btn-outline-light" style="float: right;" onclick="ajaxSimple('content','../controllers/comprobantesController.php',3)"><span class="fas -fa-sync-alt"></span>&nbsp;&nbsp;Refrescar
              			</button>
	                </div>`);
				} else {
				    $('#btnNotacreditoGENERATE').removeAttr('disabled');
				    $('#btnNotacreditoGENERATE').attr('disabled','true');
				    $('#btnNotacreditoGENERATE').text('ERROR GUARDANDO DATOS');
				}
			});
		} else {
	    	$('#msjhistorialventas').html(`
	    		<div class="alert alert-danger alert-dismissible fade show" role="alert">
		            <strong>ERROR!</strong> No se ha podido generar la Nota.
		            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		              <span aria-hidden="true">&times;</span>
		            </button>
		        </div>
	    	`);
		    $('#btnNotacreditoGENERATE').removeAttr('disabled');
		    $('#btnNotacreditoGENERATE').attr('disabled','true');
		    $('#btnNotacreditoGENERATE').text('ERROR');
		}
	});
}
function modalDestroy() {
	$('body').removeAttr('class');
	$('body').attr('class','sidebar-mini');
	$('body').removeAttr('style');
	$('body').attr('style','height: auto;');
	$('.modal-backdrop').remove();
}
function proforma() {
	if( $('#ckxProforma').prop('checked') ) {
		$('#divFecfin').css('display','none')
		$('#fecfin').removeAttr('required')
		$('#txttipocomprobante').val('PROFORMA')
		$('#serie').val('0001')
	} else {
		if($('#tipdoc_cli').val() == 1) {
			$('#txttipocomprobante').val('BOLETA DE VENTA ELECTRONICA')
			$('#serie').val('BBB1')
		} else if($('#tipdoc_cli').val() == 6) {
			$('#txttipocomprobante').val('FACTURA DE VENTA ELECTRONICA')
			$('#serie').val('FFF1')
		} else {
			$('#txttipocomprobante').val('COMPROBANTE ELECTRÓNICO')
			$('#serie').val('')
		}
	}
}
function credito() {
	if( $('#ckxProforma').prop('checked') ) {
		$('#divFecfin').css('display','none')
		$('#fecfin').removeAttr('required')
	} else {
		if( $('#ckxCredito').prop('checked') ) {
			$('#divFecfin').css('display','')
			$('#fecfin').removeAttr('required')
			$('#fecfin').attr('required','true')
		} else {
			$('#divFecfin').css('display','none')
			$('#fecfin').removeAttr('required')
		}
	}
}
function RegistroCliente(e) {
	e.preventDefault();
	$('#btnClienteINSERT').removeAttr('disabled');
    $('#btnClienteINSERT').attr('disabled',true);
    $('#btnClienteINSERT').text('Guardando...');
    var frmClienteINSERT = document.getElementById('frmRegistroCliente');
	var data = new FormData(frmClienteINSERT);
	fetch('../controllers/clienteController.php?op=2',{
		method: 'POST',
		body: data
	})
	.then(res => res.json())
	.then(data => {
      var msjRegistroCliente = document.getElementById('msjRegistroCliente');
      if (data.STATUS === 'OK') {
        msjRegistroCliente.innerHTML = `
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>CORRECTO!</strong> Cliente ingresado correctamente.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        `;
        frmClienteINSERT.reset();
        $('#btnClienteINSERT').removeAttr('disabled');
        $('#btnClienteINSERT').text('GUARDAR');
      } else {
        msjRegistroCliente.innerHTML = `
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>ERROR!</strong> No se ha podido ingresar cliente.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        `;
        $('#btnClienteINSERT').text('GUARDAR');
      }
	})
}