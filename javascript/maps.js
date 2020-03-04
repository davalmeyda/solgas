var tvar;
function ver_repartidores(estado) {
    if (navigator.geolocation) {
        __ajax('../controllers/mapsController.php?op=3', 'POST', 'JSON').done(function (data) {
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
                    if (estado == 1) {
                        marker2 = new google.maps.Marker({
                            map: map,
                            draggable: false,
                            //animation: google.maps.Animation.DROP,
                            icon: '../dist/img/cochesolgas' + color + '.png',
                            position: pos
                        });
                        setTimeout((function (marker2, i) {
                            return function () {
                                marker2.setMap(null);
                            }
                        })(marker2, i), 5000);
                        google.maps.event.addListener(marker2, 'click', (function (marker2, i) {
                            return function () {
                                InfoRepartidor(data.DATA[i]);
                            }
                        })(marker2, i));
                        marker2.addListener('click', function () {
                            $('#my_lat').val(this.getPosition().lat());
                            $('#my_lng').val(this.getPosition().lng());
                            draw_rute();
                        });
                    }
                }
                if (estado == 1) {
                    tvar = setTimeout(function () { ver_repartidores(1); }, 5000);
                    $('#btn-verRepartidores').removeAttr('onclick');
                    $('#btn-verRepartidores').attr('onclick','ver_repartidores(0);');
                    $('#btn-verRepartidores').text('OCULTAR');
                    $('#btn-verRepartidores').removeClass('btn-info');
                    $('#btn-verRepartidores').addClass('btn-warning');
                } else {
                    clearTimeout(tvar);
                    $('#btn-verRepartidores').removeAttr('onclick');
                    $('#btn-verRepartidores').attr('onclick','ver_repartidores(1);');
                    $('#btn-verRepartidores').text('MOSTRAR');
                    $('#btn-verRepartidores').removeClass('btn-warning');
                    $('#btn-verRepartidores').addClass('btn-info');
                    draw_rute_remove();
                    $('#my_lat').val('');
                    $('#my_lng').val('');
                }
            }
        });
    }
}
function InfoRepartidor(data) {
    var panel = `
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <div id="content">
            <h5 id="firstHeading" class="firstHeading">${data.nombres_per}</h5>
            <div id="bodyContent">
                <strong>Ult. vez</strong> ${data.fecha_repmap}`;
        if (data.estado_repmap == 1) {
        panel += `<button id="btnasignar${data.id_repmap}" class="btnInfoWindows btn btn-primary btn-block btn-xs mt-2" onclick="mdlAsignarRuta(${data.id_repmap})">Asignar</button>`;
        }
        if (data.estado_repmap == 2) {
        panel += `<span class="btn bg-warning btn-block btn-xs mt-2">Asignado</span>
            <button class="btn btn-secondary btn-block btn-xs" onclick="mdlVerPedido(${data.id_repmap})">Ver pedido</button>
            <button class="btn btn-danger btn-block btn-xs" onclick="liberarpedido(${data.id_repmap})">Liberar pedido</button>
        `;
        }
        if (data.estado_repmap == 3) {
        panel += `<span class="btn bg-info btn-block btn-xs mt-2">Pendiente</span>
            <button class="btn btn-secondary btn-block btn-xs" onclick="mdlVerPedido(${data.id_repmap})">Ver pedido</button>
        `;
        }
        panel += `</div>
        </div>
    `;
    $('#mdlbodyInfoRepartidor').html(panel);
    modalShow('mdlInfoRepartidor');
}