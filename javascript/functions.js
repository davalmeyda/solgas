var map;
var america_lat = -12.173782;
var america_lng = -76.9600107;
var directionsDisplay = new google.maps.DirectionsRenderer({polylineOptions:{strokeColor:'#2E9AFE'}});
var directionsService = new google.maps.DirectionsService();


function start_map(){
	map = new google.maps.Map(document.getElementById('map'), {
  	center: {lat: america_lat, lng: america_lng},
  	zoom: 11
	});
}
function centermap(lat,lng) {
  const center = new google.maps.LatLng(lat, lng);
  window.map.panTo(center);
}
function start_mdlmap(){
  mdlmap = new google.maps.Map(document.getElementById('mdlmap'), {
    center: {lat: america_lat, lng: america_lng},
    zoom: 11
  });
}



function marcar_my_location(){
  if(navigator.geolocation){
  	navigator.geolocation.getCurrentPosition (
        function(position){
      $('#btnUbicaionSELECT').attr('disabled','true');
  		$('#lat_cli').val(position.coords.latitude);
  		$('#lng_cli').val(position.coords.longitude);
   		var pos = {
      		lat: position.coords.latitude,
      		lng: position.coords.longitude
    	};
    	marker = new google.maps.Marker({
		    map: map,
		    draggable: true,
		    animation: google.maps.Animation.DROP,
		    position: pos
		  });
        marker.addListener("dblclick", function() {
            //escribimos las coordenadas de la posicion actual del marcador dentro del input #coords
          $('#lat_cli').val(this.getPosition().lat());
  		    $('#lng_cli').val(this.getPosition().lng());
            marker.setMap(null)
            $('#btnUbicaionSELECT').removeAttr('disabled');
            $('#btnUbicaionSAVE').attr('disabled','true');
        });  
            
        marker.addListener( 'dragend', function (event) {
            //escribimos las coordenadas de la posicion actual del marcador dentro del input #coords
          $('#lat_cli').val(this.getPosition().lat());
  		    $('#lng_cli').val(this.getPosition().lng());
        });
        $('#btnUbicaionSAVE').removeAttr('disabled');
  	});
    //draw_rute();
  }
}
function marcar_location_cliente(lat, lng) {
  var id_cli = $('#id_cli').val();
  var infowindow = new google.maps.InfoWindow();
  var pos = {
      lat: parseFloat(lat),
      lng: parseFloat(lng)
  };
  markercli = new google.maps.Marker({
    map: map,
    draggable: false,
    icon: '../dist/img/usuariosolgas.png',
    position: pos
  });
  google.maps.event.addListener(markercli, 'click', (function(markercli, id_cli) {
    return function() {
      __ajax('../controllers/mapsController.php?op=13','POST','JSON',{'id_cli': id_cli})
      .done(function(data) {
        var ultcomprovante = 'No tiene pedidos.';
        var nultatencion = '';
        if (data.DATA[0].ultimo_comprovante) {
          ultcomprovante = data.DATA[0].ultimo_comprovante;
          nultatencion = `<h6><strong style="opacity:0;">Ult pedido :</strong> ${data.DATA[0].nultima_atencion}</h6>`;
        }
        infowindow.setContent(`
          <div id="content">
            <h5><strong>${data.DATA[0].nombres_cli}</strong></h5>
            <h6><strong>Bal prestados: </strong> ${parseInt('0'+data.DATA[0].balones_prestados)} und</h6>
            <h6><strong>Ult pedido :</strong> ${ultcomprovante}</h6>
            ${nultatencion}
          </div>
        `);
        infowindow.open(map, markercli);
      })
    }
  })(markercli, id_cli));
}


function draw_rute(){
  var id_cli = $('#id_cli').val();
	var my_lat = $('#my_lat').val();
  var my_lng = $('#my_lng').val();
  var lat_cliOLD = $('#lat_cli').val();
  var lng_cliOLD = $('#lng_cli').val();
  __ajax('../controllers/mapsController.php?op=4','POST','JSON',{'id_cli': id_cli})
  .done(function(data) {
    if (data.STATUS == 'OK') {
      if (data.DATA.length > 0) {
          //markerREMOVE(lat_cliOLD,lng_cliOLD);
          $('#lat_cli').val(data.DATA[0].lat_climap);
          $('#lng_cli').val(data.DATA[0].long_climap);
        if(data.DATA[0].id_climap != null) {
          marcar_location_cliente(data.DATA[0].lat_climap, data.DATA[0].long_climap);
          $('#btnUbicaionSAVE').attr('disabled','true');
          $('#btnUbicaionSELECT').removeAttr('disabled');
          if (id_cli > 0 && my_lat !="" && my_lng !="") {
            draw_rute_map(data.DATA[0].lat_climap, data.DATA[0].long_climap);
            $('.btnInfoWindows').removeAttr('disabled');
          }
        } else {
          $('#msjMaps').html(`
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>ALERTA!</strong>&nbsp; El cliente no cuenta con ubicacion.
            </div>
          `);
          setTimeout(function(){$('#msjMaps').html('');},3000);
          $('#btnUbicaionSAVE').attr('disabled','true');
          $('#btnUbicaionSELECT').removeAttr('disabled');
          $('.btnInfoWindows').attr('disabled','true');
          draw_rute_remove();
        }
      } else {
        $('#btnUbicaionSAVE').attr('disabled','true');
          $('#btnUbicaionSELECT').attr('disabled','true');
          $('.btnInfoWindows').attr('disabled','true');
          draw_rute_remove();
          $('#lat_cli').val('');
          $('#lng_cli').val('');

      }
    }
  })
}

function draw_rute_map(lat, lng){
	var my_lat = $('#my_lat').val();
	var my_lng = $('#my_lng').val();
  var start = new google.maps.LatLng(my_lat, my_lng);
  var end = new google.maps.LatLng(lat, lng);
  var request = {
    origin: start,
    destination: end,
    travelMode: google.maps.TravelMode.DRIVING
  };
  directionsService.route(request, function (response, status) {
    if(status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(response);
        directionsDisplay.setMap(map);
        directionsDisplay.setOptions({suppressMarkers: false});
    }
  });
}
function draw_rute_remove() {
  var my_lat = $('#my_lat').val();
  var my_lng = $('#my_lng').val();
  var lat = $('#lat_cli').val();
  var lng = $('#lng_cli').val();
  var start = new google.maps.LatLng(my_lat, my_lng);
  var end = new google.maps.LatLng(lat, lng);
  var request = {
    origin: start,
    destination: end,
    travelMode: google.maps.TravelMode.DRIVING
  };
  directionsService.route(request, function (response, status) {
    if(status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setMap(null);
    }
  });
}

function guardar_ubi(){
    var lat_cli = $('#lat_cli').val();
    var lng_cli = $('#lng_cli').val();
    var id_cli = $('#id_cli').val();
    __ajax('../controllers/mapsController.php?op=1','POST','JSON',{'lat_cli':lat_cli,'lng_cli':lng_cli,'id_cli':id_cli}).done(function(info) {
      if (info.STATUS == 'OK') {
        $('#msjMaps').html(`
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>CORRECTO!</strong> Ubicacion guardada exitosamente.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        `);
        markerREMOVE(lat_cli, lng_cli)
        $('#btnUbicaionSAVE').attr('disabled','true');
      } else {
        $('#msjMaps').html(`
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>ERROR!</strong> No se pudo guardar.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        `);
      }
    })
}
function markerREMOVE(lat_cli, lng_cli) {
    console.log(lat_cli, lng_cli)
  var pos = {
    lat: parseFloat(lat_cli),
    lng: parseFloat(lng_cli)
  };
  marker = new google.maps.Marker({
    map: map,
    draggable: true,
    position: pos
  });
  //setTimeout(function(){marker.setMap(null);alert('elimindo'+lat_cli+' + '+lng_cli)},1);
}
function guardar_ubiRepartidor(id_per, contador) {
  var i = 1 + parseInt(contador);
  if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        function(position){
      var latitud = position.coords.latitude;
      var longitud = position.coords.longitude;

      var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
      };
      if (i == 1) {
        marker = new google.maps.Marker({
          map: map,
          draggable: false,
          animation: google.maps.Animation.DROP,
          icon: '../dist/img/cochesolgas.png',
          position: pos
        });
        setTimeout(function(){marker.setMap(null);},5000);
      } else {
        marker = new google.maps.Marker({
          map: map,
          draggable: false,
          icon: '../dist/img/cochesolgas.png',
          position: pos
        });
        setTimeout(function(){marker.setMap(null);},5000);
      }
      __ajax('../controllers/mapsController.php?op=2','POST','JSON',{'latitud':latitud,'longitud':longitud,'id_per':id_per}).done(function(info) {
        if (info.STATUS == 'OK') {
          $('#lat_per').val(`${latitud}`);
          $('#lng_per').val(`${longitud}`);
          /*if (calcularDistancia(latitud,longitud) < 100) {
            $('#btnLlegada').removeAttr('disabled');
          } else {
            $('#btnLlegada').attr('disabled',true);
          }*/
          setTimeout(function(){ guardar_ubiRepartidor(id_per,i); }, 5000);
        } else {
          $('#msjMaps').html(`
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>ERROR!</strong> No se pudo guardar tu ubicacion actual.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          `);
        }
      })
    })
  }
}
function ver_repartidores() {
  if(navigator.geolocation){
    __ajax('../controllers/mapsController.php?op=3','POST','JSON').done(function(data) {
      if (data.STATUS == 'OK') {
        var infowindow = new google.maps.InfoWindow();
        for (var i in data.DATA) {
          var pos = {
            lat: parseFloat(data.DATA[i].lat_repmap),
            lng: parseFloat(data.DATA[i].long_repmap)
          };
          var color = '';
          if (data.DATA[i].estado_repmap == 1) {
            color = 'GREEN';
          }
          if (data.DATA[i].estado_repmap == 2) {
            color = '';
          }
          if (data.DATA[i].estado_repmap == 3) {
            color = 'RED';
          }
          marker2 = new google.maps.Marker({
            map: map,
            draggable: false,
            //animation: google.maps.Animation.DROP,
            icon: '../dist/img/cochesolgas' + color + '.png',
            position: pos
          });
          setTimeout((function(marker2, i) {
            return function() {
              marker2.setMap(null);
            }
          })(marker2, i),5000);
          google.maps.event.addListener(marker2, 'click', (function(marker2, i) {
            return function() {
              console.log(data.DATA[i].estado_repmap)
              var panel = `
                <div id="content">
                  <h5 id="firstHeading" class="firstHeading">${data.DATA[i].nombres_per}</h5>
                  <div id="bodyContent">
                    <strong>Ult. vez</strong> ${data.DATA[i].fecha_repmap}`;
              if (data.DATA[i].estado_repmap == 1) {
                panel += `<button id="btnasignar${data.DATA[i].id_repmap}" class="btnInfoWindows btn btn-primary btn-block btn-xs mt-2" onclick="mdlAsignarRuta(${data.DATA[i].id_repmap})">Asignar</button>`;
              }
              if (data.DATA[i].estado_repmap == 2) {
                panel += `<span class="btn bg-warning btn-block btn-xs mt-2">Asignado</span>
                <button class="btn btn-secondary btn-block btn-xs" onclick="mdlVerPedido(${data.DATA[i].id_repmap})">Ver pedido</button>
                <button class="btn btn-danger btn-block btn-xs" onclick="liberarpedido(${data.DATA[i].id_repmap})">Liberar pedido</button>
                `;
              }
              if (data.DATA[i].estado_repmap == 3) {
                panel += `<span class="btn bg-info btn-block btn-xs mt-2">Pendiente</span>
                <button class="btn btn-secondary btn-block btn-xs" onclick="mdlVerPedido(${data.DATA[i].id_repmap})">Ver pedido</button>
                `;
              }
              panel += `</div>
                </div>
              `;
              infowindow.setContent(panel);
              infowindow.open(map, marker2);
            }
          })(marker2, i));
          marker2.addListener('click', function() {
            $('#my_lat').val(this.getPosition().lat());
            $('#my_lng').val(this.getPosition().lng());
            draw_rute();
          });
        }
        setTimeout(function(){ver_repartidores(); }, 5000);
      }
    });
  }
}
function mdlAsignarRuta(id_repmap) {
  var id_cli = $('#id_cli').val();
  __ajax('../controllers/mapsController.php?op=5','POST','JSON',{'id_cli' : id_cli})
  .done(function(data) {
    if (data.STATUS == 'OK') {
      var modal = `<div class="content">
          <div class="container-fluid" style="height: 60vh;overflow-y: auto;">`;
      for (var i in data.DATA) {
        modal += `
          <div class="row">
            <div class="col">`;
        if (data.DATA[i].tipo_comprobante == 1) {
        modal += `<a class="card" href="javascript:$('#txtNombre_ven').val('FACTURA ELECTRONICA » ${data.DATA[i].serie_ven}-${data.DATA[i].correlativo_ven}');$('#id_ven').val(${data.DATA[i].id_ven});$('#btnAsignar').removeAttr('disabled')" style="color: #000">`;
        }       
        if (data.DATA[i].tipo_comprobante == 3) {
        modal += `<a class="card" href="javascript:$('#txtNombre_ven').val('BOLETA DE VENTA ELECTRÓNICA » ${data.DATA[i].serie_ven}-${data.DATA[i].correlativo_ven}');$('#id_ven').val(${data.DATA[i].id_ven});$('#btnAsignar').removeAttr('disabled')" style="color: #000">`;
        }
        modal += `<div class="card-header" style="border: 0">
                  <div class="col-12">`;
        if (data.DATA[i].tipo_comprobante == 1) {
        modal += `<h3 class="card-title">FACTURA ELECTRONICA » ${data.DATA[i].serie_ven}-${data.DATA[i].correlativo_ven}</h3>`
        }
        if (data.DATA[i].tipo_comprobante == 3) {
        modal += `<h3 class="card-title">BOLETA DE VENTA ELECTRÓNICA » ${data.DATA[i].serie_ven}-${data.DATA[i].correlativo_ven}</h3>`
        }
        modal += `</div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-9">
                      <div class="col-12">
                        <span class="fas fa-user-alt"></span> ${data.DATA[i].nombres_cli} (${data.DATA[i].numdoc_cli})
                      </div>
                      <div class="col-12">
                        <span class="fas fa-clock"></span> ${data.DATA[i].nfecini_ven}
                      </div>
                    </div>
                    <div class="col-3">
                      <span style="font-size: 15pt;" class="text-success">S/ <span style="font-size: 15pt;">${data.DATA[i].total_ven}</span></span>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>`;
      }
      modal += `</div>
              <div class="container-fluid mt-2">
                <input id="txtNombre_ven" class="form-control" type="text" readonly>
                <input id="id_ven" class="form-control" type="hidden" readonly>
                <button id="btnAsignar" type="button" class="btn btn-primary btn-block mt-2" onclick="AsignarRuta(${id_repmap})" disabled>ASIGNAR</button>
              </div>
            </div>`;
      $('#mdlbodymdlAsignarRuta').html(modal);
    }
  })
  modalShow('mdlAsignarRuta');
}
function mdlVerPedido(id_repmap) {
  __ajax('../controllers/mapsController.php?op=9','POST','JSON',{'id_repmap' : id_repmap})
  .done(function(data) {
    if (data.STATUS == 'OK') {
      var modal = `<div class="content">
          <div class="container-fluid" style="max-height: 60vh;overflow-y: auto;">`;
      for (var i in data.DATA) {
        modal += `
            <div class="row">
              <div class="col">
                <div class="card" style="color: #000">
                  <div class="card-header" style="border: 0">
                    <div class="col-12">
                      <h3 class="card-title"> ${data.DATA[i].descripcion_balven}</h3>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="col-12">
                          <span class="fas fa-file-alt"></span> ${data.DATA[i].nombre_ven}
                        </div>
                      </div>
                      <div class="col-3">
                        <span style="font-size: 15pt;" class="text-success"><span style="font-size: 15pt;">${parseInt(data.DATA[i].cantidad_balven)}</span> und</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>`;
      }
      $('#mdlbodymdlVerPedido').html(modal);
    }
  })
  modalShow('mdlVerPedido');
}
function AsignarRuta(id_repmap) {
  $('.btnInfoWindows').attr('disabled','true');
  var id_ven = $('#id_ven').val();
  var my_lat = $('#my_lat').val();
  var my_lng = $('#my_lng').val();
  var lat_cli = $('#lat_cli').val();
  var lng_cli = $('#lng_cli').val();
  var cabecera = {
    'id_repmap': id_repmap,
    'id_ven': id_ven,
    'my_lat': my_lat,
    'my_lng': my_lng,
    'lat_cli': lat_cli,
    'lng_cli': lng_cli
  }
  var data = JSON.stringify(cabecera);
  console.log(data);
  __ajax('../controllers/mapsController.php?op=6','POST','JSON',{'data':data})
  .done(function(info) {
    if (info.STATUS == 'OK') {
      $('#btnasignar'+id_repmap).parent().html(`
        <button class="btn bg-info btn-block btn-xs mt-2">Pendiente</button>
        <button class="btn btn-secondary btn-block btn-xs" onclick="mdlVerPedido(${id_repmap})">Ver pedido</button>
      `);
      var nRows = $('#tblRutamaps > tbody > tr').length;
      $('#tblRutamaps tbody').append(`<tr>
          <td>${parseInt(nRows)+1}</td>
          <td>${info.DATA[0].nombres_per}</td>
          <td>${info.DATA[0].nombres_cli}</td>
          <td>${info.DATA[0].nombre_ven}</td>
          <td>${info.DATA[0].nfecha_rutmap}</td>
          <td><button class="btn btn-outline-info btn-sm" onclick="mdlMapaSHOW(${info.DATA[0].id_repmap},${info.DATA[0].lat_ori},${info.DATA[0].lng_ori},${info.DATA[0].lat_des},${info.DATA[0].lng_des})"><span class="fas fa-eye"></span></button></td>
        </tr>`);
      modalHide('mdlAsignarRuta');
      $('#msjMaps').html(`
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>CORRECTO!</strong> Asignado correctamente.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
      `);
    } else {
      modalHide('mdlAsignarRuta');
      $('#msjMaps').html(`
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>ERROR!</strong> No se pudo asignar ruta. ${info.ERROR}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
      `);
    }
  })
}
function liberarpedido(id_repmap) {
  __ajax('../controllers/mapsController.php?op=14','POST','JSON',{'id_repmap' : id_repmap})
  .done(function(data) {
    if (data.STATUS == 'OK') {
      $('#msjMaps').html(`
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>CORRECTO!</strong> Pedido liberado correctamente.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
      `);
    } else {
      $('#msjMaps').html(`
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>ERROR!</strong> El pedido no pudo ser liberado.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
      `);
    }
  })
}
function mostrarRuta(id_per,estado_rutmap) {
  fetch('../controllers/mapsController.php?op=8&id_per='+id_per+'&estado_rutmap='+estado_rutmap,{
    method: 'POST'
  })
  .then(res => res.json())
  .then(data => {
    if (data.DATA.length != 0) {
      if (estado_rutmap == 1) {
        $('#msjMaps').html(`
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>ALERTA!</strong> Usted fue asignado a repartir productos.
          <button type="button" class="float-right btn btn-sm btn-secondary" onclick="RechazarRuta(${data.DATA[0].id_rutmap},${data.DATA[0].id_repmap},${data.DATA[0].id_ven})">Rechazar</button>
          <button id="btnAceptarRuta" type="button" class="float-right btn btn-sm btn-primary mr-2" onclick="AceptarRuta(${data.DATA[0].id_rutmap},${data.DATA[0].id_repmap},${data.DATA[0].id_ven})">Aceptar</button>
          </div>
        `);
      }
      if (estado_rutmap == 2) {
        $('#msjMaps').html(`
          <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>GRACIAS!</strong> Acepto a repartir productos, en marcha.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>
        `);
      }
      draw_rute_mapREPARTIDOR(data.DATA[0].lat_ori, data.DATA[0].lng_ori, data.DATA[0].lat_des, data.DATA[0].lng_des);
      $('#lat_des').val(`${data.DATA[0].lat_des}`);
      $('#lng_des').val(`${data.DATA[0].lng_des}`);
      $('#btnLlegada').removeAttr('onclick');
      $('#btnLlegada').attr('onclick',`TerminarRecorrido(${data.DATA[0].id_rutmap},${data.DATA[0].id_repmap},${data.DATA[0].id_ven})`)
      $('#tblbotones').html(`
          <button id="btnRegistro" class="btn btn-dark btn-block" onclick="RegistrarBalones(${data.DATA[0].id_ven})">REGISTRAR BALONES</button>
        `);
    } else {
      $('#msjMaps').html(`
        <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong>DATO!</strong> Actualemente no tiene rutas aceptadas.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
      `);
    }
  })
}
function calcularDistancia(lat_des,lng_des) {
  if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        function(position){
      var latitud = position.coords.latitude;
      var longitud = position.coords.longitude;
        rad = function(x) {return x*Math.PI/180;}
        var R = 6378.137; //Radio de la tierra en km
        var dLat = rad( lat_des - latitud );
        var dLong = rad( lng_des - longitud );
        var a = Math.sin(dLat/2) * Math.sin(dLat/2) + Math.cos(rad(latitud)) * Math.cos(rad(lat_des)) * Math.sin(dLong/2) * Math.sin(dLong/2);
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
        var d = R * c;
        return parseFloat(d)*1000;
    })
  }
}
function TerminarRecorrido(id_rutmap,id_repmap,id_ven) {
  var nfilas = $('#tblBalonxu_venta > tbody > tr').length;
  var nfilass = $('#tblBalonxu_venta > tbody > tr > select').length;
  if (nfilas > 0 && nfilass <= 0) {
    __ajax('../controllers/mapsController.php?op=12','POST','JSON',{'id_rutmap':id_rutmap,'id_repmap':id_repmap,'id_ven':id_ven}).done(function(info) {
      if (info.STATUS == 'OK') {
        start_map();
        $('#msjMaps').html(`
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>CORRECTO! </strong> Ya termino el recorrido.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        `);
        $('#lat_des').val('');
        $('#lng_des').val('');
        $('#btnLlegada').attr('disabled',true);
      } else {
        $('#msjMaps').html(`
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>ERROR!</strong> Acaba de ocurrir un error. ${info.ERROR}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        `);
      }
    })
  } else {
    $('#msjMaps').html(`
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>ALERTA!</strong> No termina de registrar los balones.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    `);
  }
}
function RechazarRuta(id_rutmap,id_repmap,id_ven) {
  __ajax('../controllers/mapsController.php?op=17','POST','JSON',{'id_rutmap':id_rutmap,'id_repmap':id_repmap,'id_ven':id_ven}).done(function(info) {
    if (info.STATUS == 'OK') {
      start_map();
      $('#msjMaps').html(`
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>CORRECTO </strong> Ya rechazo el recorrido.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      `);
      $('#lat_des').val('');
      $('#lng_des').val('');
      $('#btnLlegada').attr('disabled',true);
    } else {
      $('#msjMaps').html(`
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>ERROR!</strong> Acaba de ocurrir un error. ${info.ERROR}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      `);
    }
  })
}
function AceptarRuta(id_rutmap,id_repmap,id_ven) {
  $('#btnAceptarRuta').attr('disabled');
  $('#btnAceptarRuta').text('cargando...');
  __ajax('../controllers/mapsController.php?op=18','POST','JSON',{'id_rutmap':id_rutmap,'id_repmap':id_repmap,'id_ven':id_ven}).done(function(info) {
    if (info.STATUS == 'OK') {
      start_map();
      mostrarRuta(info.DATA[0].id_per,2)
      $('#msjMaps').html(`
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>CORRECTO </strong> Ya acepto el recorrido. Ha empezar ya!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      `);
      $('#lat_des').val('');
      $('#lng_des').val('');
      $('#btnLlegada').attr('disabled',true);
    } else {
      $('#msjMaps').html(`
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>ERROR!</strong> Acaba de ocurrir un error. ${info.ERROR}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      `);
    }
  })
}
function draw_rute_mapREPARTIDOR(latori, lngori, latdes, lngdes){
  var start = new google.maps.LatLng(latori, lngori);
  var end = new google.maps.LatLng(latdes, lngdes);
  var request = {
    origin: start,
    destination: end,
    travelMode: google.maps.TravelMode.DRIVING
  };
  directionsService.route(request, function (response, status) {
    if(status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(response);
        directionsDisplay.setMap(map);
        directionsDisplay.setOptions({suppressMarkers: false});
    }
  });
}
function mdlVerrepartidorMaps(id_repmap) {
  __ajax('../controllers/mapsController.php?op=10','POST','JSON',{'id_repmap':id_repmap}).done(function(data) {
    if (data.STATUS == 'OK') {
      var pos = {
        lat: parseFloat(data.DATA[0].lat_repmap),
        lng: parseFloat(data.DATA[0].long_repmap)
      };
      marker = new google.maps.Marker({
        map: mdlmap,
        draggable: false,
        icon: '../dist/img/cochesolgas.png',
        position: pos
      });
      setTimeout(function(){marker.setMap(null);},5000);
      setTimeout(function(){mdlVerrepartidorMaps(id_repmap); }, 5000);
    }
  })
}
function mdldraw_rute_mapREPARTIDOR(latori, lngori, latdes, lngdes){
  var start = new google.maps.LatLng(latori, lngori);
  var end = new google.maps.LatLng(latdes, lngdes);
  var request = {
    origin: start,
    destination: end,
    travelMode: google.maps.TravelMode.DRIVING
  };
  directionsService.route(request, function (response, status) {
    if(status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(response);
        directionsDisplay.setMap(mdlmap);
        directionsDisplay.setOptions({suppressMarkers: false});
    }
  });
}
function mdlMapaSHOW(id_repmap,lat_ori,lng_ori,lat_des,lng_des) {
  mdlVerrepartidorMaps(id_repmap);
  mdldraw_rute_mapREPARTIDOR(lat_ori,lng_ori,lat_des,lng_des);
  modalShow('mdlMapa');
}