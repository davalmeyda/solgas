function ajaxSimple(id,controlador,op) {
    $("#"+id).load(controlador + "?op=" + op);
}
function  ajaxCompuesto(id,controlador,op,data) {
    $("#"+id).load(controlador + "?op=" + op + "&" + data);
}
function  ajaxPagina(id,pagina) {
    $("#"+id).load(pagina);
}
function Pagina(pagina) {
    window.location=pagina;
}
function etiquetaREMOVE(id) {
    $(id).remove();
}
function checkbox(id, estado) {
    $('#'+id).prop('checked', estado);
}
function __ajax(direccion,tipo,tipodata,datos){
  var ajax = $.ajax({
    url: direccion,
    type: tipo,
    dataType: tipodata,
    data: datos
  });
  return ajax;
}
function modalShow(modal) {
    $('#'+modal).modal("show");
}
function modalHide(modal) {
    $('#'+modal).modal("hide");
}
function sumarDias(fecha,dias) {
    fecha.setDate(fecha.getDate() + dias);
    return fecha;
}
function transformFecha(hoy){
    var Y = hoy.getFullYear();
    var m = hoy.getMonth()+1;
    var d = hoy.getDate();
        
    d = addZero(d);
    m = addZero(m);

    var H = hoy.getHours();
    var i = hoy.getMinutes();
    var s = hoy.getSeconds();
 
    return Y+'-'+m+'-'+d+' '+H+':'+i+':'+s;
}
function addZero(i) {
    if (i < 10) {
        i = '0' + i;
    }
    return i;
}
function modalDestroy() {
	$('body').removeAttr('class');
	$('body').attr('class','sidebar-mini');
	$('body').removeAttr('style');
	$('body').attr('style','height: auto;');
	$('.modal-backdrop').remove();
}