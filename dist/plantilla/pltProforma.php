<?php
  date_default_timezone_set("America/Lima");
  function getpltProforma($proformaDATA, $balon_proformaSELECT) {
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
          <td style="text-align: center;border: 1px solid #000; width: 150px">
            <div>RUC 20603003421</div>
            <h2 class="name" style="font-size: 14px;">PROFORMA</h2>
            <div>' . $proformaDATA['DATA'][0]['serie_ven'] . '-' . $proformaDATA['DATA'][0]['correlativo_ven'] . '</div>
          </td>
        </tr>
      </table>
      <br>
      <table style="width: 100%;">
        <tbody>
          <tr>
            <td class="text-bold">
              <div>RUC/DNI</div>
            </td>
            <td>
              <div>' . $proformaDATA['DATA'][0]['numdoc_cli'] . '</div>
            </td>
            <td style="text-align: center">
              <div class="text-bold">FECHA EMISIÓN</div>
            </td>
            <td style="text-align: center">
              <div>' . date("d/m/Y", strtotime($proformaDATA['DATA'][0]['fecini_ven'])) . '</div>
            </td>
          </tr>
          <tr>
            <td class="text-bold">
              <div>CLIENTE</div>
            </td>
            <td>
              <div>' . $proformaDATA['DATA'][0]['nombres_cli'] . '</div>
            </td>
            <td style="text-align: center">
              <div class="text-bold">FECHA VENCIMIENTO</div>
            </td>
            <td style="text-align: center">
              <div>' . date("d/m/Y", strtotime($proformaDATA['DATA'][0]['fecfin_ven'])) . '</div>
            </td>
          </tr>
          <tr>
            <td class="text-bold">
              <div>DIRECCION</div>
            </td>
            <td>
              <div>' . $proformaDATA['DATA'][0]['direccion_cli'] . '</div>
            </td>
            <td style="text-align: center">
              <div class="text-bold">MONEDA</div>
            </td>
            <td style="text-align: center">
              <div>SOLES</div>
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
            <td style="text-align: center;">
              <h2 class="name" style="font-size: 12px">P. UNITARIO</h2>
            </td>
            <td style="text-align: center;">
              <h2 class="name" style="font-size: 12px">TOTAL</h2>
            </td>
          </tr>
        </thead>
        <tbody>';
        $i=0;
        $total_ven = 0;
        foreach ($balon_proformaSELECT['DATA'] as $list) {
          $i++;
        $plantilla .= '<tr>
            <td style="text-align: center;border-right: 1px solid #000">' . $i . '</td>
            <td style="text-align: center;border-right: 1px solid #000">UND</td>
            <td style="text-align: center;border-right: 1px solid #000">' . $list['id_balpro'] . '</td>
            <td style="text-align: left;border-right: 1px solid #000">' . $list['descripcion_balven'] . '</td>
            <td style="text-align: right">' . $list['cantidad_balven'] . '</td>
            <td style="text-align: right">' . $list['precio_unitario'] . '</td>
            <td style="text-align: right">' . $list['valor_balven'] . '</td>
          </tr>';
          $total_ven = $total_ven+$list['valor_balven'];
        }
      $plantilla .= '</tbody>
        <tfooter>
          <tr>
            <td colspan="4" style="text-align: right">GRAVADO</td>
            <td colspan="1" style="text-align: right">S/</td>
            <td colspan="2" style="text-align: right">' . number_format(round($total_ven / 1.18, 2), 2) . '</td>
          </tr>
          <tr>
            <td colspan="4" style="text-align: right">I.G.V.</td>
            <td colspan="1" style="text-align: right">S/</td>
            <td colspan="2" style="text-align: right">' . number_format(round($total_ven * 9/59, 2), 2) . '</td>
          </tr>
          <tr>
            <td colspan="4" style="text-align: right">TOTAL</td>
            <td colspan="1" style="text-align: right">S/</td>
            <td colspan="2" style="text-align: right">' . number_format($total_ven, 2) . '</td>
          </tr>
        </tfooter>
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
        <tr>
          <td class="text-bold">
            <div>CUENTAS BANCARIAS</div>
          </td>
          <td colspan="3" style="text-align: center">
            <div>BCP 570-2507441-0-61</div>
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
