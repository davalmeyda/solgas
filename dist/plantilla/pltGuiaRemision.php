<?php
  date_default_timezone_set("America/Lima");
  function getpltGuiaRemision($guiaremisionDATA, $balon_guiaSELECT) {
    $tipoenvio = $guiaremisionDATA['DATA'][0]['tipoenvio'];
    if ($tipoenvio == 1) {
      $ntipoenvio = 'VENTAS';
    } else {
      $ntipoenvio = 'OTROS';
    }
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
            <h2 class="name" style="font-size: 14px;">GUIA DE REMISION REMITENTE ELECTRONICA</h2>
            <div>' . $guiaremisionDATA['DATA'][0]['serie_gui'] . '-' . $guiaremisionDATA['DATA'][0]['correlativo_gui'] . '</div>
          </td>
        </tr>
      </table>
      <br>
      <table class="border-all" style="width: 100%;">
        <thead>
          <tr style="background-color: #eaecee">
            <td colspan="4">
              <h2 class="name" style="font-size: 14px;">DESTINATARIO</h2>
            </td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-bold">
              <div>RUC/DNI</div>
            </td>
            <td>
              <div>' . $guiaremisionDATA['DATA'][0]['numdoc_cli'] . '</div>
            </td>
            <td style="text-align: center">
              <div class="text-bold">FECHA EMISIÓN</div>
            </td>
            <td style="text-align: center">
              <div>' . date("d/m/Y", strtotime($guiaremisionDATA['DATA'][0]['fecemi_gui'])) . '</div>
            </td>
          </tr>
          <tr>
            <td class="text-bold">
              <div>RAZON SOCIAL</div>
            </td>
            <td>
              <div>' . $guiaremisionDATA['DATA'][0]['nombres_cli'] . '</div>
            </td>
            <td colspan="2">
            </td>
          </tr>
          <tr>
            <td class="text-bold">
              <div>DIRECCION</div>
            </td>
            <td>
              <div>' . $guiaremisionDATA['DATA'][0]['direccion_cli'] . '</div>
            </td>
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
            <td class="text-bold">
              <div>TIPO ENVIO</div>
            </td>
            <td>
              <div>' . $ntipoenvio . '</div>
            </td>
            <td style="text-align: left">
              <div class="text-bold">FECHA DE ENVÍO</div>
            </td>
            <td styl=e"text-align: left">
              <div>' . date("d/m/Y", strtotime($guiaremisionDATA['DATA'][0]['fecenvio'])) . '</div>
            </td>
          </tr>
          <tr>
            <td class="text-bold">
              <div>PESO BRUTO TOTAL</div>
            </td>
            <td>
              <div>' . $guiaremisionDATA['DATA'][0]['peso'] . ' KGM</div>
            </td>
            <td style="text-align: left">
              <div class="text-bold">NÚMERO DE BULTOS</div>
            </td>
            <td style="text-align: left">
              <div>' . $guiaremisionDATA['DATA'][0]['cantbultos'] . '</div>
            </td>
          </tr>
          <tr>
            <td class="text-bold">
              <div>PUNTO DE PARTIDA</div>
            </td>
            <td colspan="3">
              <div>' . $guiaremisionDATA['DATA'][0]['nombre_ubiori'] . ' - ' . $guiaremisionDATA['DATA'][0]['direccionori'] . '</div>
            </td>
          </tr>
          <tr>
            <td class="text-bold">
              <div>PUNTO DE LLEGADA</div>
            </td>
            <td colspan="3">
              <div>' . $guiaremisionDATA['DATA'][0]['nombre_ubides'] . ' - ' . $guiaremisionDATA['DATA'][0]['direcciondes'] . '</div>
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
            <td class="text-bold">
              <div>TIPO DE TRANSPORTE</div>
            </td>
            <td>
              <div>TRANSPORTE ' . $guiaremisionDATA['DATA'][0]['movilidad'] . '</div>
            </td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td class="text-bold">
              <div>CONDUCTOR</div>
            </td>
            <td>
              <div>' . $guiaremisionDATA['DATA'][0]['nombres_transportista'] . '</div>
            </td>
            <td style="text-align: center">
              <div class="text-bold">PLACA</div>
            </td>
            <td style="text-align: center">
              <div>AVO-707</div>
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
        foreach ($balon_guiaSELECT['DATA'] as $list) {
          $i++;
        $plantilla .= '<tr>
            <td style="text-align: center;border-right: 1px solid #000">' . $i . '</td>
            <td style="text-align: center;border-right: 1px solid #000">UND</td>
            <td style="text-align: center;border-right: 1px solid #000">' . $list['id_bal'] . '</td>
            <td style="text-align: left;border-right: 1px solid #000">' . $list['nombre_bal'] . '</td>
            <td style="text-align: right">' . $list['cantidad_balgui'] . '</td>
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
            <div>PIDA SU BIDON DE AGUA DE 20 LITROS AL 981171149</div>
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
