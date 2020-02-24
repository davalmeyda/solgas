<?php
  $id_bal = $_GET['id_bal'];
  session_start();
  $balonxuSELECT = $_SESSION['balonxuSELECT'];
?>
<table>
<?php foreach ($balonxuSELECT['DATA'] as $list) { ?>
  <tr>
    <td style="width: 494px">
      <svg id="barcode<?= $list['id_balxu'] ?>"></svg>
    </td>
  </tr>
<?php } ?>
</table>
<script>
  $(function () {
    $("#tblBalonSELECT").DataTable();
    __ajax('../controllers/balonController.php?op=17&id_bal=<?= $id_bal ?>','POST','JSON').done(function(info) {
      if (info.STATUS == 'OK') {
        for(var i in info.DATA) {
          obtenerbarcodeList(`${info.DATA[i].codbar_balxu}`,info.DATA[i].id_balxu)
        }
      }
    })
  });
</script>
