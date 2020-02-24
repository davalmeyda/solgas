<?php
  date_default_timezone_set("America/Lima");
  function getpltGuiaTransportista($guiatransportistaDATA, $balon_guitraSELECT) {
    $plantilla = '<body>
      <table id="encabezado">
        <tr>
          <td>
            <div id="logo">
              <img src="../dist/plantilla/logosolgas.png" width="100">
            </div>
          </td>
          <td>
            <div id="company">
              <h2 class="name" style="font-size: 14px;">INVERSIONES Y MULTISERVICIOS ACN S.A.C</h2>
              <div>PRINCIPAL >> CAL. GUZMAN BARRON NRO. 256 URB. VISTA ALEGRE LA LIBERTAD - TRUJILLO - VISTOR LARCO HERRERA</div>
              <div class="normal">044 377706</div>
              <div class="normal">991986146</div>
              <div class="normal"><a href="mailto:company@example.com">inversionesmultiserviciosacn@gmail.com</a></div>
            </div>
          </td>
          <td style="text-align: center;border: 1px solid #000">
            <div>RUC 20603003421</div>
            <h2 class="name" style="font-size: 14px;">GUÍA DE TRANSPORTISTA ELECTRONICA</h2>
            <div>' . $guiatransportistaDATA['DATA'][0]['serie_ven'] . '-' . $guiatransportistaDATA['DATA'][0]['numero_ven'] . '</div>
          </td>
        </tr>
      </table>
      <br>
      <table class="border-all" style="width: 100%;">
        <thead>
          <tr style="background-color: #eaecee">
            <td colspan="4">
              <h2 class="name" style="font-size: 14px;">TRANSPORTISTA</h2>
            </td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-bold">
              <div>RUC/DNI</div>
            </td>
            <td>
              <div>' . $guiatransportistaDATA['DATA'][0]['ruc_guitra'] . '</div>
            </td>
            <td style="text-align: center">
              <div class="text-bold">FECHA EMISIÓN</div>
            </td>
            <td style="text-align: center">
              <div>' . date("d/m/Y", strtotime($guiatransportistaDATA['DATA'][0]['fecha_guitra'])) . '</div>
            </td>
          </tr>
          <tr>
            <td class="text-bold">
              <div>RAZON SOCIAL</div>
            </td>
            <td>
              <div>' . $guiatransportistaDATA['DATA'][0]['nombres_guitra'] . '</div>
            </td>
            <td colspan="2">
            </td>
          </tr>
          <tr>
            <td class="text-bold">
              <div>NOMBRE COMERCIAL</div>
            </td>
            <td>';
          if ($guiatransportistaDATA['DATA'][0]['ruc_guitra'] != NULL || $guiatransportistaDATA['DATA'][0]['ruc_guitra'] != "") {
            $plantilla .= '<div>' . $guiatransportistaDATA['DATA'][0]['nombres_guitra'] . '</div>';
          }
          $plantilla .= '</td>
            <td colspan="2">
            </td>
          </tr>
        </tbody>
      </table>
      <br>
      <table class="border-all" style="width: 100%;">
        <thead>
          <tr style="background-color: #eaecee">
            <td colspan="4">
              <h2 class="name" style="font-size: 14px;">ENVIO</h2>
            </td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-bold" style="width: 200px;">
              <div>TIPO PRODUCTO</div>
            </td>
            <td>
              <div>BALONES DE GAS Y AGUA</div>
            </td>
            <td style="text-align: left">
              <div class="text-bold">FECHA DE ENVÍO</div>
            </td>
            <td styl=e"text-align: left">
              <div>' . date("d/m/Y") . '</div>
            </td>
          </tr>
          <tr>
            <td class="text-bold" style="width: 200px;">
              <div>PUNTO DE PARTIDA</div>
            </td>
            <td colspan="3">
              <div>' . $guiatransportistaDATA['DATA'][0]['puntopartida_guitra'] . '</div>
            </td>
          </tr>
          <tr>
            <td class="text-bold" style="width: 200px;">
              <div>PUNTO DE LLEGADA</div>
            </td>
            <td colspan="3">
              <div>' . $guiatransportistaDATA['DATA'][0]['puntollegada_guitra'] . '</div>
            </td>
          </tr>
        </tbody>
      </table>
      <br>
      <table class="border-all" style="width: 100%;">
        <thead>
          <tr style="background-color: #eaecee">
            <td colspan="4">
              <h2 class="name" style="font-size: 14px;">TRANSPORTE</h2>
            </td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-bold" style="width: 200px;">
              <div>TIPO DE TRANSPORTE</div>
            </td>
            <td>
              <div>TRANSPORTE PRIVADO</div>
            </td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td class="text-bold" style="width: 200px;">
              <div>CONDUCTOR</div>
            </td>
            <td>
              <div>' . $guiatransportistaDATA['DATA'][0]['nombres_guitra'] . '</div>
            </td>
            <td style="text-align: center">
              <div class="text-bold">PLACA</div>
            </td>
            <td style="text-align: center">
              <div>' . $guiatransportistaDATA['DATA'][0]['placa_guitra'] . '</div>
            </td>
          </tr>
          <tr>
            <td class="text-bold" style="width: 200px;">
              <div>NUMERO DE CONSTANCIA</div>
            </td>
            <td colspan="3">
              <div>' . $guiatransportistaDATA['DATA'][0]['nconstancia_guitra'] . '</div>
            </td>
          </tr>
          <tr>
            <td class="text-bold" style="width: 200px;">
              <div>NUMERO DE LICENCIA</div>
            </td>
            <td colspan="3">
              <div>' . $guiatransportistaDATA['DATA'][0]['nlicencia_guitra'] . '</div>
            </td>
          </tr>
        </tbody>
      </table>
      <br>
      <table class="border-all" style="width: 100%;">
        <thead>
          <tr style="background-color: #eaecee">
            <td style="text-align: center;border-right: 1px solid #000">
              <h2 class="name" style="font-size: 12px">Nº</h2>
            </td>
            <td style="text-align: center;border-right: 1px solid #000">
              <h2 class="name" style="font-size: 12px">UNIDAD</h2>
            </td>
            <td style="text-align: center;border-right: 1px solid #000">
              <h2 class="name" style="font-size: 12px">CÓDIGO</h2>
            </td>
            <td style="border-right: 1px solid #000">
              <h2 class="name" style="font-size: 12px;">DESCRIPCIÓN</h2>
            </td>
            <td style="text-align: center;">
              <h2 class="name" style="font-size: 12px">CANTIDAD</h2>
            </td>
          </tr>
        </thead>
        <tbody>';
        $i=0;
        foreach ($balon_guitraSELECT['DATA'] as $list) {
          $i++;
        $plantilla .= '<tr>
            <td style="text-align: center;border-right: 1px solid #000">' . $i . '</td>
            <td style="text-align: center;border-right: 1px solid #000">UND</td>
            <td style="text-align: center;border-right: 1px solid #000">' . $list['id_bal'] . '</td>
            <td style="text-align: left;border-right: 1px solid #000">' . $list['nombre_bal'] . '</td>
            <td style="text-align: right">' . $list['cantidad_balguitra'] . '</td>
          </tr>';
        }
      $plantilla .= '</tbody>
      </table>
      <br>
      <table class="border-all" style="width: 100%;">
        <tr>
          <td class="text-bold">
            <div>USUARIO</div>
          </td>
          <td colspan="3" style="text-align: center">
            <div>INVERSIONES Y MULTISERVICIOS ACN - ' . date("d/m/Y h:i A", strtotime(date("Y-m-d H:i"))) . '</div>
          </td>
        </tr>
      </table>
      <br>
      <table class="border-all" style="width: 100%;">
        <tr>
          <td>
            <div>Autorizado mediante resolución Nº 034-005-0010431/S UNAT</div>
            <div>Representación impresa de la GUIA DE REMISION REMITENTE ELECTRONICA</div>
            <div>Para consultar el comprobante visita www.keyfacil.com</div>
            <div>Resumen n9gxhVHLjtU3oCyCIws3Ajja8Rw=</div>
          </td>
        </tr>
      </table>
      <br>
      <table style="width: 100%;text-align: center">
        <tr>
          <td>
            <!--<div>PIDA SU BIDON DE AGUA DE 20 LITROS AL 981171149</div>-->
          </td>
        </tr>
      </table>
      <br>
      <table style="width: 100%;text-align: center">
        <tr>
          <td class="text-bold">
            <div>KeyFacil™</div>
          </td>
        </tr>
        <tr>
          <td style="font-size: 10px">
            <div>Comprobante emitido a través de <strong>www.keyfacil.com</strong></div>
          </td>
        </tr>
      </table>
    </body>
    ';
    return $plantilla;
  }
?>
