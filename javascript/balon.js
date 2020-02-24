function cambiofecha(num) {
	if (num==1) {
		$('#divFecha_pre').css('display','');
		$('#tipo_pre').removeAttr('onchange');
		$('#tipo_pre').attr('onchange','cambiofecha(2)');
	} else {
		$('#divFecha_pre').css('display','none');
		$('#tipo_pre').removeAttr('onchange');
		$('#tipo_pre').attr('onchange','cambiofecha(1)');
	}
}
function tipo_balCHANGE(tipo) {
	$('#categoria_bal').removeAttr('disabled');
	$('#txtNombre_bal').removeAttr('readonly');
	$('#sltMarca_bal').removeAttr('disabled');
	$('#nbrPeso_bal').removeAttr('readonly');
	$('#txtColor_bal').removeAttr('disabled');
	$('#precio_bal').removeAttr('readonly');
	$('#sltId_prov').removeAttr('disabled');
	$('#codigo_fac').removeAttr('readonly');
	var sltTipo_bal = document.getElementById('sltTipo_bal');
	vTipo_bal = sltTipo_bal.value;
	var divColor_bal = document.getElementById('divColor_bal');
	var sltMarca_bal = document.getElementById('sltMarca_bal');
	if (vTipo_bal === 'AGUA') {
		divColor_bal.style.display = "none";
		fetch('../controllers/balonController.php?op=15&tipo=AGUA')
		.then(res => res.json())
		.then(data => {
			var selectMarca = '<option value="">-----</option>';
			for (var i in data.DATA) {
				selectMarca += `<option value="${data.DATA[i].id_mar}">${data.DATA[i].nota_mar}</option>`;
			}
			sltMarca_bal.innerHTML = selectMarca;
		})
		$('#divCategoria_bal').css('display','none');
	} else {
		divColor_bal.style.display = "";
		fetch('../controllers/balonController.php?op=15&tipo=GAS')
		.then(res => res.json())
		.then(data => {
			var selectMarca = '<option value="">-----</option>';
			for (var i in data.DATA) {
				selectMarca += `<option value="${data.DATA[i].id_mar}">${data.DATA[i].nota_mar}</option>`;
			}
			sltMarca_bal.innerHTML = selectMarca;
		})
		$('#divCategoria_bal').css('display','');
	}
	frmBalonINSERT_CLEAN();
	const data = new FormData();
	data.append('tipo_bal', vTipo_bal);
	fetch('../controllers/balonController.php?op=11', {
		method : 'POST',
		body: data
	})
	.then(res => res.json())
	.then(data => {
		$('#sltId_bal').html(`<option value="0">PRODUCTO NUEVO</option>`);
		for (var i in data.DATA) {
			$('#sltId_bal').append(`
				<option value="${data.DATA[i].id_bal}">${data.DATA[i].nombre_bal}</option>
			`);
		}
	})
}
function productoCHANGE(valor,tipo) {
	if (valor == '0') {
		$('#txtNombre_bal').removeAttr('readonly');
		$('#nbrPeso_bal').removeAttr('readonly');
		$('#txtColor_bal').removeAttr('disabled');
		$('#categoria_bal').removeAttr('disabled');
		$('#sltMarca_bal').removeAttr('readonly');
		$('#sltId_prov').removeAttr('readonly');
		document.getElementById('frmBalonINSERT').reset();
		$("#sltTipo_bal option[value="+tipo+"]").attr("selected",true);
	} else {
		const data = new FormData();
		data.append('id_bal', valor);
		fetch('../controllers/balonController.php?op=12', {
			method : 'POST',
			body: data
		})
		.then(res => res.json())
		.then(data => {
			$('#txtNombre_bal').val(data.DATA[0].nombre_bal);
			$('#txtNombre_bal').attr('readonly','true');
			$('#nbrPeso_bal').val(data.DATA[0].peso_bal);
			$('#nbrPeso_bal').attr('readonly','true');
			$('#txtColor_bal').val(data.DATA[0].color_bal);
			$('#txtColor_bal').attr('disabled','true');
			$('#precio_bal').val(data.DATA[0].precio_bal);
			$('#precio_bal').attr('readonly','true');
			//$("#sltMarca_bal option").removeAttr('selected');
			if (data.DATA[0].categoria_bal == 'PREMIUN') {
				$('#categoria_bal').removeAttr('checked');
				$("#categoria_bal").attr("checked",true);
				$('#categoria_bal').attr('disabled','true');
			} else {
				$('#categoria_bal').removeAttr('checked');
				$('#categoria_bal').attr('disabled','true');
			}
			$('#sltMarca_bal').removeAttr('selected');
			$("#sltMarca_bal option[value="+data.DATA[0].marca_bal+"]").attr("selected",true);
			$('#sltMarca_bal').attr('disabled','true');
			$('#txtColor_bal').removeAttr('selected');
			$("#txtColor_bal option[value="+data.DATA[0].color_bal+"]").attr("selected",true);
			$('#txtColor_bal').attr('disabled','true');
			$('#sltId_prov').removeAttr('selected');
			$("#sltId_prov option[value="+data.DATA[0].proveedor_bal+"]").attr("selected",true);
			$('#sltId_prov').attr('disabled','true');
			$('#codigo_fac').val(data.DATA[0].codigo_fac);
			$('#codigo_fac').attr('readonly','true');
			obtenerbarcodeList(`${data.DATA[0].barcode_bal}`,'');
		})
	}
}
function frmBalonINSERT_CLEAN() {
	$('#txtNombre_bal').val('');
	$('#nbrCantidad_regbal').val('');
	$('#nbrPeso_bal').val('');
	$('#precio_bal').val('');
	$('#codigo_fac').val('');
	$("#sltMarca_bal option").removeAttr('selected');
	$("#sltMarca_bal option[value='']").attr("selected",true);
	$("#txtColor_bal option").removeAttr('selected');
	$("#txtColor_bal option[value='']").attr("selected",true);
	$("#sltId_bal option").removeAttr('selected');
	$("#sltId_bal option[value='0']").attr("selected",true);
	$('#sltMarca_bal').removeAttr('disabled');
	$('#nbrPeso_bal').removeAttr('readonly');
	$('#txtColor_bal').removeAttr('disabled');
	$('#precio_bal').removeAttr('readonly');
	$('#sltId_prov').removeAttr('disabled');
	$('#codigo_fac').removeAttr('readonly');
}
function balonDELETE(id_bal, row) {
	const data = new FormData();
	data.append('id_bal', id_bal);
	fetch('../controllers/balonController.php?op=6', {
		method : 'POST',
		body: data
	})
	.then(res => res.json())
	.then(data => {
		var mensajeBalon = document.getElementById('mensajeBalon');
		if (data.STATUS === 'OK') {
	        mensajeBalon.innerHTML = `
	          <div class="alert alert-success alert-dismissible fade show" role="alert">
	            <strong>CORRECTO!</strong> Balón inabilitado correctamente.
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	          </div>
	        `;
	        $('#trBalonSELECT'+row+' .estado').text('INACTIVO');
	        $('#trBalonSELECT'+row+' .estado').removeAttr('class');
	        $('#trBalonSELECT'+row+' .estado').attr('class','text-center text-danger estado');
      	} else {
      		mensajeBalon.innerHTML = `
	          <div class="alert alert-danger alert-dismissible fade show" role="alert">
	            <strong>ERROR!</strong> No se pudo inabilitar el balón.
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	          </div>
	        `;
      	}
	})
}
function obtenerbarcode(id_col,codigo_fac,id_mar,local) {
	var id_col = parseInt('0'+id_col);
	var codigo_fac = parseInt('0'+codigo_fac);
	var codigobar = zfill(id_col,2)+""+zfill(codigo_fac,4)+""+zfill(id_mar,2)+""+zfill(local,10);
	$('#precodbar').val(codigobar);
	JsBarcode("#barcode", codigobar,{
		format: "CODE128",
		lineColor: "#000",
		width: 2,
		height: 30,
		displayValue: true
	})
}
function obtenerbarcodeList(codbar,id_bal) {
	$('#precodbar').val(codbar);
	JsBarcode("#barcode"+id_bal, codbar,{
		format: "CODE128",
		lineColor: "#000",
		width: 2,
		height: 30,
		displayValue: true
	})
}
function arrayjsonbarcode(j) {
    	var json=JSON.parse(j);
    	var arr = [];
    	for (var x in json) {
    		arr.push(json[x]);
    	}
    	return arr;
    }
function zfill(number, width) {
    var numberOutput = Math.abs(number); /* Valor absoluto del número */
    var length = number.toString().length; /* Largo del número */ 
    var zero = "0"; /* String de cero */  
    
    if (width <= length) {
        if (number < 0) {
             return ("-" + numberOutput.toString()); 
        } else {
             return numberOutput.toString(); 
        }
    } else {
        if (number < 0) {
            return ("-" + (zero.repeat(width - length)) + numberOutput.toString()); 
        } else {
            return ((zero.repeat(width - length)) + numberOutput.toString()); 
        }
    }
}