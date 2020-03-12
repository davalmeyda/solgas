<?php
require_once '../models/util/conexionBD.php';
require_once '../models/bean/balonBean.php';
    date_default_timezone_set("America/Lima");
class balonDao {
	public function balonSELECT() {
		$query = "SELECT * FROM (SELECT id_bal, feccre_bal, nombre_bal, total_bal, cantidad_bal, marca_bal, peso_bal, color_bal, tipo_bal, precio_bal, categoria_bal, estado_bal, codigo_fac, barcode_bal, id_prov, marca.nota_mar, colores.nota_col FROM balon
            INNER JOIN marca ON marca.id_mar=balon.marca_bal
            INNER JOIN colores ON colores.id_col=balon.color_bal
            UNION ALL
            SELECT id_bal, feccre_bal, nombre_bal, total_bal, cantidad_bal, marca_bal, peso_bal, color_bal, tipo_bal, precio_bal, categoria_bal, estado_bal, codigo_fac, barcode_bal, id_prov, marca.nota_mar, 'UNICO' AS nota_col FROM balon
            INNER JOIN marca ON marca.id_mar=balon.marca_bal
            WHERE color_bal not in (SELECT id_col FROM colores)
            )a";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function balonSELECT_estadobal($estado_bal) {
		$query = "SELECT * FROM (SELECT id_bal, feccre_bal, nombre_bal, total_bal, cantidad_bal, marca_bal, peso_bal, color_bal, tipo_bal, precio_bal, categoria_bal, estado_bal, codigo_fac, barcode_bal, id_prov, marca.nota_mar, colores.nota_col FROM balon
            INNER JOIN marca ON marca.id_mar=balon.marca_bal
            INNER JOIN colores ON colores.id_col=balon.color_bal
            UNION ALL
            SELECT id_bal, feccre_bal, nombre_bal, total_bal, cantidad_bal, marca_bal, peso_bal, color_bal, tipo_bal, precio_bal, categoria_bal, estado_bal, codigo_fac, barcode_bal, id_prov, marca.nota_mar, 'UNICO' AS nota_col FROM balon
            INNER JOIN marca ON marca.id_mar=balon.marca_bal
            WHERE color_bal not in (SELECT id_col FROM colores)
            )a WHERE estado_bal='$estado_bal'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
    public function balonActivosSELECT_tipobal($tipo_bal) {
        $query = "SELECT * FROM (SELECT id_bal, feccre_bal, nombre_bal, total_bal, cantidad_bal, marca_bal, peso_bal, color_bal, tipo_bal, precio_bal, categoria_bal, estado_bal, codigo_fac, barcode_bal, id_prov, marca.nota_mar, colores.nota_col FROM balon
            INNER JOIN marca ON marca.id_mar=balon.marca_bal
            INNER JOIN colores ON colores.id_col=balon.color_bal
            UNION ALL
            SELECT id_bal, feccre_bal, nombre_bal, total_bal, cantidad_bal, marca_bal, peso_bal, color_bal, tipo_bal, precio_bal, categoria_bal, estado_bal, codigo_fac, barcode_bal, id_prov, marca.nota_mar, 'UNICO' AS nota_col FROM balon
            INNER JOIN marca ON marca.id_mar=balon.marca_bal
            WHERE color_bal not in (SELECT id_col FROM colores)
            )a WHERE estado_bal=1 AND tipo_bal='$tipo_bal'";
        $objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
    }
	public function productoSELECT($tipo) {
		$query = "SELECT id_bal, feccre_bal, nombre_bal, total_bal, cantidad_bal, marca_bal, peso_bal, color_bal, tipo_bal, precio_bal, categoria_bal, estado_bal, codigo_fac, barcode_bal, id_prov FROM balon WHERE tipo_bal='$tipo'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
    public function balonxuSELECT_idbal($id_bal) {
        $query = "SELECT balonxu.id_balxu, balonxu.codbar_balxu, balon.id_bal, balon.nombre_bal, balon.tipo_bal, balonxu.estado_balxu
            FROM balonxu
            INNER JOIN balon ON balonxu.id_bal=balon.id_bal
            WHERE estado_balxu='1' AND balon.id_bal='$id_bal'";
        $objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
    }
    public function balonxuSELECT_idbalcantidad($id_bal,$cantidad) {
        $query = "SELECT balonxu.id_balxu, balonxu.codbar_balxu, balon.id_bal, balon.nombre_bal, balon.tipo_bal, balonxu.estado_balxu
            FROM balonxu
            INNER JOIN balon ON balonxu.id_bal=balon.id_bal
            WHERE estado_balxu='1' AND balon.id_bal='$id_bal' ORDER BY balonxu.id_balxu DESC LIMIT " . $cantidad;
        $objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
    }
    public function marcaSELECT() {
        $query = "SELECT id_mar, nota_mar, tipo FROM marca";
        $objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
    }
    public function marcaSELECT_tipo($tipo) {
        $query = "SELECT id_mar, nota_mar, tipo FROM marca WHERE tipo='$tipo'";
        $objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
    }
    public function coloresSELECT() {
        $query = "SELECT id_col, nota_col FROM colores";
        $objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
    }
    public function balonSEARCH($parametro) {
        $query = "SELECT id_bal, feccre_bal, feccre_bal, nombre_bal, total_bal, cantidad_bal, marca_bal, peso_bal, color_bal, tipo_bal, precio_bal, categoria_bal, estado_bal, codigo_fac, barcode_bal, id_prov FROM balon WHERE id_bal LIKE'%$parametro%' OR nombre_bal LIKE'%$parametro%'";
        $objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
    }
	public function balonINSERT(balonBean $objBalonBean) {
		$query = "INSERT INTO balon(id_bal, feccre_bal, nombre_bal, total_bal, cantidad_bal, marca_bal, peso_bal, color_bal, precio_bal, tipo_bal, categoria_bal, estado_bal, codigo_fac, barcode_bal, id_prov) VALUES (NULL,'" . $objBalonBean->getFeccre_bal() . "','" . $objBalonBean->getNombre_bal() . "','" . $objBalonBean->getTotal_bal() . "','" . $objBalonBean->getCantidad_bal() . "','" . $objBalonBean->getMarca_bal() . "','" . $objBalonBean->getPeso_bal() . "','" . $objBalonBean->getColor_bal() . "','" . $objBalonBean->getPrecio_bal() . "','" . $objBalonBean->getTipo_bal() . "','" . $objBalonBean->getCategoria_bal() . "',1,'" . $objBalonBean->getCodigo_fac() . "','" . $objBalonBean->getBarcode_bal() . "','" . $objBalonBean->getId_prov() . "')";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        if ($answer['STATUS'] == 'OK') {
        	$id_bal = $answer['ID'];
        	$query = "INSERT INTO registrobalon(id_regbal, fecha_regbal, cantidad_regbal, id_bal, id_per) VALUES (NULL,'" . $objBalonBean->getFecha_regbal() . "','" . $objBalonBean->getCantidad_regbal() . "','$id_bal','" . $objBalonBean->getId_per() . "')";
			$objConexionBD = new ConexionBD();
	        $answer = $objConexionBD->exe_data($query);
            $answer['ID'] = $id_bal;
        }
        return $answer;
	}
	public function registrobalonINSERT(balonBean $objBalonBean) {
		$query = "INSERT INTO registrobalon(id_regbal, fecha_regbal, cantidad_regbal, id_bal, id_per) VALUES (NULL,'" . $objBalonBean->getFecha_regbal() . "','" . $objBalonBean->getCantidad_regbal() . "','" . $objBalonBean->getId_bal() . "','" . $objBalonBean->getId_per() . "')";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
    public function balonxuINSERT($codbar_balxu,$id_bal) {
        $query = "INSERT INTO balonxu(id_balxu, fecha_balxu, codbar_balxu, estado_balxu, id_bal) VALUES (NULL,'" . date('Y-m-d H:i:s') . "','$codbar_balxu', 1,'$id_bal')";
        $objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
    }
	public function total_balUPDATE($total,$id_bal) {
		$query = "UPDATE balon SET total_bal=total_bal+'$total', cantidad_bal=cantidad_bal+'$total' WHERE id_bal='$id_bal'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
    public function cantidad_balRESTAUPDATE($id_bal,$cantidad_bal) {
        $query = "UPDATE balon SET cantidad_bal=cantidad_bal-'$cantidad_bal' WHERE id_bal='$id_bal'";
        $objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
    }
	public function cantidad_balSUMAUPDATE($cantidad_bal,$id_bal) {
        $query = "UPDATE balon SET cantidad_bal=cantidad_bal+'$cantidad_bal' WHERE id_bal='$id_bal'";
        $objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function balonDATA($id_bal) {
		$query = "SELECT id_bal, nombre_bal, total_bal, cantidad_bal, marca_bal, peso_bal, color_bal, precio_bal, tipo_bal, categoria_bal, estado_bal, codigo_fac, barcode_bal, id_prov FROM balon WHERE id_bal='$id_bal'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function balonUPDATE(balonBean $objBalonBean) {
		$query = "UPDATE balon SET nombre_bal='" . $objBalonBean->getNombre_bal() . "',total_bal=total_bal+'" . $objBalonBean->getCantidad_bal() . "',cantidad_bal=cantidad_bal+'" . $objBalonBean->getCantidad_bal() . "',marca_bal='" . $objBalonBean->getMarca_bal() . "',peso_bal='" . $objBalonBean->getPeso_bal() . "',color_bal='" . $objBalonBean->getColor_bal() . "',precio_bal='" . $objBalonBean->getPrecio_bal() . "',tipo_bal='" . $objBalonBean->getTipo_bal() . "',categoria_bal='" . $objBalonBean->getCategoria_bal() . "',codigo_fac='" . $objBalonBean->getCodigo_fac() . "',barcode_bal='" . $objBalonBean->getBarcode_bal() . "',id_prov='" . $objBalonBean->getId_prov() . "' WHERE id_bal='" . $objBalonBean->getId_bal() . "'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function balonDELETE($id_bal) {
		$query = "UPDATE balon SET estado_bal=2 WHERE id_bal='$id_bal'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function estado_balUPDATE($id_bal,$estado_bal) {
		$query = "UPDATE balon SET estado_bal='$estado_bal' WHERE id_bal='$id_bal'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function balon_prestamoSELECT($id_pre) {
		$query = "SELECT balon_prestamo.id_balpre, balon_prestamo.fecini_balpre, balon_prestamo.fecfin_balpre, balon_prestamo.total_balpre, balon_prestamo.cantidad_balpre, balon_prestamo.fecfin_balpre, balon_prestamo.estado_balpre, balon.id_bal, balon.nombre_bal, balon.marca_bal, balon.peso_bal, balon.color_bal, balon.precio_bal, balon.tipo_bal, proveedor.id_prov, proveedor.razsoc_prov, balon_prestamo.id_pre
		FROM balon_prestamo
		INNER JOIN balon ON balon_prestamo.id_bal=balon.id_bal
		INNER JOIN proveedor ON balon.id_prov=proveedor.id_prov
		WHERE balon_prestamo.id_pre='$id_pre'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
    public function balonxuDATA($id_balxu) {
        $query = "SELECT * FROM (
            SELECT balonxu.id_balxu,balonxu.fecha_balxu,balonxu.codbar_balxu,
            balon.id_bal,balon.nombre_bal,balon.marca_bal,balon.peso_bal,balon.color_bal,balon.precio_bal,balon.tipo_bal,balon.categoria_bal,
            proveedor.id_prov,proveedor.razsoc_prov,
            venta.fecini_ven AS fecha,
            cliente.id_cli,cliente.nombres_cli,'VENDIDO' AS estado
            FROM balonxu
            INNER JOIN balon ON balonxu.id_bal=balon.id_bal
            INNER JOIN proveedor ON balon.id_prov=proveedor.id_prov
            INNER JOIN balon_venta ON balon.id_bal=balon_venta.id_bal
            INNER JOIN venta ON balon_venta.id_ven=venta.id_ven
            INNER JOIN cliente ON venta.id_cli=cliente.id_cli
            UNION ALL
            SELECT balonxu.id_balxu,balonxu.fecha_balxu,balonxu.codbar_balxu,
            balon.id_bal,balon.nombre_bal,balon.marca_bal,balon.peso_bal,balon.color_bal,balon.precio_bal,balon.tipo_bal,balon.categoria_bal,
            proveedor.id_prov,proveedor.razsoc_prov,
            balon_prestamo.fecini_balpre AS fecha,
            cliente.id_cli,cliente.nombres_cli,'PRESTADO' AS estado
            FROM balonxu
            INNER JOIN balon ON balonxu.id_bal=balon.id_bal
            INNER JOIN proveedor ON balon.id_prov=proveedor.id_prov
            INNER JOIN balon_prestamo ON balon.id_bal=balon_prestamo.id_bal
            INNER JOIN prestamo ON balon_prestamo.id_pre=prestamo.id_pre
            INNER JOIN cliente ON prestamo.id_cli=cliente.id_cli
            WHERE balon_prestamo.estado_balpre=1
            UNION ALL
            SELECT balonxu.id_balxu,balonxu.fecha_balxu,balonxu.codbar_balxu,
            balon.id_bal,balon.nombre_bal,balon.marca_bal,balon.peso_bal,balon.color_bal,balon.precio_bal,balon.tipo_bal,balon.categoria_bal,
            proveedor.id_prov,proveedor.razsoc_prov,
            NULL AS fecha,
            NULL AS id_cli,NULL AS nombres_cli,'ALMACEN' AS estado
            FROM balonxu
            INNER JOIN balon ON balonxu.id_bal=balon.id_bal
            INNER JOIN proveedor ON balon.id_prov=proveedor.id_prov
            WHERE balonxu.id_balxu NOT IN (SELECT id_balxu FROM balonxu_prestamo WHERE estado_balxupre=1) AND balonxu.id_balxu NOT IN (SELECT id_balxu FROM balonxu_venta INNER JOIN balon_venta ON balonxu_venta.id_balven=balon_venta.id_balven INNER JOIN venta ON balon_venta.id_ven=venta.id_ven WHERE estado_ven=2)
        ) a WHERE id_balxu='$id_balxu'";
        $objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
    }
    public function balon_prestamoDATA($id_balpre) {
        $query = "SELECT balon_prestamo.id_balpre, balon_prestamo.fecini_balpre, balon_prestamo.fecfin_balpre, balon_prestamo.total_balpre, balon_prestamo.cantidad_balpre, balon_prestamo.fecfin_balpre, balon_prestamo.estado_balpre, balon.id_bal, balon.nombre_bal, balon.cantidad_bal, balon.marca_bal, balon.peso_bal, balon.precio_bal, balon.color_bal, balon.tipo_bal, proveedor.id_prov, proveedor.razsoc_prov, balon_prestamo.id_pre
        FROM balon_prestamo
        INNER JOIN balon ON balon_prestamo.id_bal=balon.id_bal
        INNER JOIN proveedor ON balon.id_prov=proveedor.id_prov
        WHERE balon_prestamo.id_balpre='$id_balpre'";
        $objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
    }
	public function filtroBalonSELECT($fecini,$fecfin,$tipo_bal) {
		$query = "SELECT id_bal, feccre_bal, nombre_bal, marca_bal, peso_bal, color_bal, tipo_bal, estado_bal, id_prov FROM balon WHERE feccre_bal>='$fecini' AND feccre_bal<='$fecfin' AND tipo_bal='$tipo_bal'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function registrobalonSELECT() {
		$query = "SELECT registrobalon.id_regbal, registrobalon.fecha_regbal, registrobalon.cantidad_regbal, balon.id_bal, balon.nombre_bal, personal.id_per, CONCAT(personal.nombre_per, \" \" , personal.apellido_per) AS nombres_per
			FROM registrobalon
			INNER JOIN balon ON registrobalon.id_bal=balon.id_bal
			INNER JOIN personal ON registrobalon.id_per=personal.id_per";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
    public function estado_balxuINSERT($estado_balxu,$id_balxu) {
        $query = "UPDATE balonxu SET estado_balxu='$estado_balxu' WHERE id_balxu='$id_balxu'";
        $objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
    }
    public function balonxuEXIST_barcode($codbar_balxu) {
        $query = "SELECT id_balxu,count(*) AS count_balxu FROM balonxu WHERE codbar_balxu='$codbar_balxu'";
        $objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
    }
    public function marcaINSERT($nota_mar ,$tipo) {
        $query = "INSERT INTO marca(id_mar, nota_mar, tipo) VALUES (NULL,'" . $nota_mar .  "','" . $tipo .  "')";
        $objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
    }
    public function marcaUPDATE($id_mar, $nota_mar ,$tipo) {
        $query = "UPDATE marca SET nota_mar='" . $nota_mar .  "', tipo='" . $tipo .  "' WHERE id_mar='" . $id_mar .  "'";
        $objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
    }
    public function marcaDATA($id_mar) {
        $query = "SELECT id_mar, nota_mar, tipo FROM marca WHERE id_mar='$id_mar'";
        $objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
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