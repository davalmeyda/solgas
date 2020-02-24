<?php
require_once '../models/util/conexionBD.php';
class principalDao {
    public function NombrarFecha($fecha) {
        $anno = substr($fecha,0,4);
        $mes = substr($fecha,5,2);
        $dia = substr($fecha,8,2);
        $dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
        $nombredia = $dias[intval((date("w",mktime(0,0,0,$mes,$dia,$anno))))];
        switch ($mes) {
            case "01":$mes="Enero";break;
            case "02":$mes="Febrero";break;
            case "03":$mes="Marzo";break;
            case "04":$mes="Abril";break;
            case "05":$mes="Mayo";break;
            case "06":$mes="Junio";break;
            case "07":$mes="Julio";break;
            case "08":$mes="Agosto";break;
            case "09":$mes="Septiembre";break;
            case "10":$mes="Octubre";break;
            case "11":$mes="Noviembre";break;
            case "12":$mes="Diciembre";break;
        }
        return $nombredia . " " . $dia . " " . $mes;
    }
    public function NombrarFecha2($fecha) {
        $mes = substr($fecha,5,2);
        $dia = substr($fecha,8,2);
        switch ($mes) {
            case "01":$mes="Ene";break;
            case "02":$mes="Feb";break;
            case "03":$mes="Mar";break;
            case "04":$mes="Abr";break;
            case "05":$mes="May";break;
            case "06":$mes="Jun";break;
            case "07":$mes="Jul";break;
            case "08":$mes="Ago";break;
            case "09":$mes="Sep";break;
            case "10":$mes="Oct";break;
            case "11":$mes="Nov";break;
            case "12":$mes="Dic";break;
        }
        return $mes . " " . $dia;
    }
    public function amoldarHora($hora) {//00:00
        $hor = substr($hora,0,2);
        $min = substr($hora,3,2);
        $hora = "";
        if ($hor <= 12) {
            $hora = $hor . ":" . $min . "am";
        } else {
            $hor = $hor-12;
            if ($hor < 10) {
                $hora = "0" . $hor . ":" . $min . "pm";
            } else {
                $hora = $hor . ":" . $min . "pm";
            }
        }
        return $hora;
    }
}
?>