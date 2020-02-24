<?php
	session_start();
	$Stipo_per = $_SESSION['TIPO_PER'];
	$balonSELECT = $_SESSION['balonSELECT'];
?>
<div class="table-responsive">
<table id="tblBalonSELECT" class="table table-bordered table-striped">
	<thead>
		<tr>
          	<!--<th class="text-center">
                <div class="custom-control custom-checkbox">
                    <input id="checkBalonALL" type="checkbox" onchange="checkBalonALL()" class="custom-control-input">
                    <label for="checkBalonALL" class="custom-control-label"></label>
                </div>
            </th>-->
			<th class="text-center">ID</th>
			<th>NOMBRE</th>
			<th class="text-center">MARCA</th>
			<th class="text-center">TIPO</th>
			<th class="text-center">PESO</th>
			<th class="text-center">COLOR</th>
			<th class="text-center">ESTADO</th>
		<?php if ($Stipo_per == "1" || $Stipo_per == "2") { ?>
			<th class="text-center">ACCIONES</th>
		<?php } ?>
		</tr>
	</thead>
	<tbody>
	<?php $i=0;foreach ($balonSELECT['DATA'] as $list) { ?>
		<tr id="trBalonSELECT<?= $i ?>">
			<!--<td class="text-center">
                <div class="custom-control custom-checkbox">
                <?php if ($list['estado_bal'] == '1') { ?>
                    <input id="checkBalon<?= $i ?>" type="checkbox" name="checkBalon" class="custom-control-input">
                <?php } else { ?>
                    <input id="checkBalon<?= $i ?>" type="checkbox" name="checkBalon" class="custom-control-input" disabled>
                <?php } ?>
                    <label for="checkBalon<?= $i ?>" class="custom-control-label"></label>
                </div>
			</td>-->
			<td class="text-center"><?= $list['id_bal'] ?></td>
			<td><?= $list['nombre_bal'] ?></td>
			<td class="text-center"><?= $list['tipo_bal'] ?></td>
			<td class="text-center"><?= $list['marca_bal'] ?></td>
			<td class="text-center"><?= $list['peso_bal'] ?></td>
			<td class="text-center"><?= $list['color_bal'] ?></td>
		<?php if ($list['estado_bal'] == '1') { ?>
			<td class="text-center text-success">ACTIVO</td>
		<?php } ?>
		<?php if ($list['estado_bal'] == '2') { ?>
			<td class="text-center text-warning">INACTIVO</td>
		<?php } ?>
		<?php if ($list['estado_bal'] == '3') { ?>
			<td class="text-center text-primary">EN USO</td>
		<?php } ?>
		<?php
			$disabled = '';
			$fecha_actual = date("Y-m-d H:i:00",strtotime(date("Y-m-d H:i:00")."- 1 days"));
			$fecha_actual = strtotime($fecha_actual);
			$fecha_entrada = strtotime($list['feccre_bal']);
			if ($Stipo_per == '2' && $fecha_actual >= $fecha_entrada) {
				$disabled = 'disabled';
			}
		?>
		<?php if ($Stipo_per == '1' || $Stipo_per == '2') { ?>
			<td class="text-center">
				<button onclick="ajaxCompuesto('subcontent','../controllers/balonController.php',4,'id_bal=<?= $list['id_bal'] ?>')" class="btn btn-outline-warning btn btn-sm" <?= $disabled ?>><span class="fas fa-edit"></span></button>
				<button onclick="balonDELETE(<?= $list['id_bal'] ?>,<?= $i ?>)" class="btn btn-outline-danger btn btn-sm" <?= $disabled ?>><span class="fas fa-trash-alt"></span></button>
			</td>
		<?php } ?>
			<input type="hidden" id="hdnId_bal<?= $i ?>" value="<?= $list['id_bal'] ?>">
			<input type="hidden" id="hdnNombre_bal<?= $i ?>" value="<?= $list['nombre_bal'] ?>">
		</tr>
	<?php $i++;} ?>
	</tbody>
</table>
</div>
<script>
  $(function () {
    $("#tblBalonSELECT").DataTable();
  });
</script>