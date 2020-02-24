<?php
  date_default_timezone_set("America/Lima");
  function getpltGuiaTransportistaREPORTE($guiatransportistaDATA) {
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
            <h2 class="name" style="font-size: 14px;">REPORTE DIARIO</h2>
            <div>Guia de transportista</div>
          </td>
        </tr>
      </table>
      <br>
      <table class="border-all" style="width: 100%;">
        <tbody>
          <tr>
            <td class="text-bold" style="width: 100px">
              <div>FECHA</div>
            <td>
              <div>' . date("d/m/Y") . '</div>
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
              <h2 class="name" style="font-size: 12px">VENTA</h2>
            </td>
            <td style="border-right: 1px solid #000">
              <h2 class="name" style="font-size: 12px">TRANSPORTISTA</h2>
            </td>
            <td style="text-align: center;border-right: 1px solid #000">
              <h2 class="name" style="font-size: 12px;">PLACA</h2>
            </td>
            <td style="border-right: 1px solid #000">
              <h2 class="name" style="font-size: 12px">DIRECCION INICIO</h2>
            </td>
            <td style="border-right: 1px solid #000">
              <h2 class="name" style="font-size: 12px">DIRECCION LLEGADA</h2>
            </td>
            <td style="text-align: center;border-right: 1px solid #000">
              <h2 class="name" style="font-size: 12px">N CONSTANCIA</h2>
            </td>
            <td style="text-align: center;border-right: 1px solid #000">
              <h2 class="name" style="font-size: 12px">N LICENCIA</h2>
            </td>
            <td style="text-align: center;">
              <h2 class="name" style="font-size: 12px">BALONES</h2>
            </td>
          </tr>
        </thead>
        <tbody>';
        $i=0;
        foreach ($guiatransportistaDATA['DATA'] as $list) {
        $plantilla .= '<tr>
            <td style="text-align: center;border-right: 1px solid #000">' . ($i+1) . '</td>
            <td style="text-align: center;border-right: 1px solid #000">' . $list['noComprobante'] . '</td>
            <td style="border-right: 1px solid #000">' . $list['nombres_guitra'] . '</td>
            <td style="text-align: center;border-right: 1px solid #000">' . $list['placa_guitra'] . '</td>
            <td style="border-right: 1px solid #000">' . $list['puntopartida_guitra'] . '</td>
            <td style="border-right: 1px solid #000">' . $list['puntollegada_guitra'] . '</td>
            <td style="text-align: center;border-right: 1px solid #000">' . $list['nconstancia_guitra'] . '</td>
            <td style="text-align: center;border-right: 1px solid #000">' . $list['nlicencia_guitra'] . '</td>
            <td>';
        for ($j=0;$j<count($guiatransportistaDATA['DATA'][$i]['balon']);$j++) {
        $plantilla .= '<span>' . $guiatransportistaDATA['DATA'][$i]['balon'][$j]['nombre_bal'] . ' &nbsp;&nbsp;' . $guiatransportistaDATA['DATA'][$i]['balon'][$j]['cantidad_balguitra'] . ' UND</span><br>';
        }
        $plantilla .= '</td>
          </tr>';
          $i++;
        }
      $plantilla .= '</tbody>
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
