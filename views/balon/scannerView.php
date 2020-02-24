<?php
	session_start();
	$balonxuDATA = $_SESSION['balonxuDATA'];
?>
<div class="col-12">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col">
					<div class="form-group row">
						<div class="col-2">
              				<label class="control-label">Cod Barras</label>
						</div>
						<div class="col-10">
              				<div class="form-control"><?= $balonxuDATA['DATA'][0]['codbar_balxu'] ?></div>
              			</div>
              		</div>
					<div class="form-group row">
						<div class="col-2">
              				<label class="control-label">Nombre</label>
						</div>
						<div class="col-10">
              				<div class="form-control"><?= $balonxuDATA['DATA'][0]['nombre_bal'] ?></div>
              			</div>
              		</div>
					<div class="form-group row">
						<div class="col-2">
              				<label class="control-label">Marca</label>
						</div>
						<div class="col-4">
              				<div class="form-control"><?= $balonxuDATA['DATA'][0]['marca_bal'] ?></div>
              			</div>
						<div class="col-2">
              				<label class="control-label">Tipo</label>
						</div>
						<div class="col-4">
              				<div class="form-control"><?= $balonxuDATA['DATA'][0]['tipo_bal'] ?></div>
              			</div>
              		</div>
              	<?php if ($balonxuDATA['DATA'][0]['tipo_bal'] == 'GAS') { ?>
					<div class="form-group row">
						<div class="col-2">
              				<label class="control-label">Categoria</label>
						</div>
						<div class="col-4">
              				<div class="form-control"><?= $balonxuDATA['DATA'][0]['categoria_bal'] ?></div>
              			</div>
						<div class="col-2">
              				<label class="control-label">Color</label>
						</div>
						<div class="col-4">
              				<div class="form-control"><?= $balonxuDATA['DATA'][0]['color_bal'] ?></div>
              			</div>
              		</div>
              	<?php } ?>
					<div class="form-group row">
						<div class="col-2">
              				<label class="control-label">Precio</label>
						</div>
						<div class="col-4">
              				<div class="form-control"><?= $balonxuDATA['DATA'][0]['precio_bal'] ?></div>
              			</div>
						<div class="col-2">
              				<label class="control-label">Proveedor</label>
						</div>
						<div class="col-4">
              				<div class="form-control"><?= $balonxuDATA['DATA'][0]['razsoc_prov'] ?></div>
              			</div>
              		</div>
					<div class="form-group row">
						<div class="col-2">
              				<label class="control-label">Fecha ingreso</label>
						</div>
						<div class="col-4">
              				<div class="form-control"><?= $balonxuDATA['DATA'][0]['fecha_balxu'] ?></div>
              			</div>
						<div class="col-2">
              				<label class="control-label">Estado</label>
						</div>
						<div class="col-4">
              				<div class="form-control"><?= $balonxuDATA['DATA'][0]['estado'] ?></div>
              			</div>
              		</div>
              	<?php if ($balonxuDATA['DATA'][0]['id_cli'] != NULL) { ?>
					<div class="form-group row">
						<div class="col-2">
              				<label class="control-label">Cliente</label>
						</div>
						<div class="col-4">
              				<div class="form-control"><?= $balonxuDATA['DATA'][0]['nombres_cli'] ?></div>
              			</div>
						<div class="col-2">
              				<label class="control-label">fec Despacho</label>
						</div>
						<div class="col-4">
              				<div class="form-control"><?= $balonxuDATA['DATA'][0]['fecha'] ?></div>
              			</div>
              		</div>
              	<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>