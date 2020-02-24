<?php
	session_start();
	$dataComprobante = $_SESSION['dataComprobante'];
	$facturaCOUNT = $dataComprobante['DATA'][0]['facturaCOUNT'];
	$boletaCOUNT = $dataComprobante['DATA'][0]['boletaCOUNT'];
	$notascreditoCOUNT = $dataComprobante['DATA'][0]['notascreditoCOUNT'];
	$notasdebitoCOUNT = $dataComprobante['DATA'][0]['notasdebitoCOUNT'];
	$proformaCOUNT = $dataComprobante['DATA'][0]['proformaCOUNT'];
	$guiaremisionCOUNT = $dataComprobante['DATA'][0]['guiaremisionCOUNT'];
	date_default_timezone_set("America/Lima");
	$fecha_actual = date('Y-m-d');
	$listmes = array('DATA' => array());
	for ($i=0;$i<6;$i++) {
		$fecha = date("Y-m-d",strtotime($fecha_actual."- ".$i." month"));
		$nmes='';
		switch (substr($fecha, 5,2)) {
			case 1:$nmes = 'Enero';break;
			case 2:$nmes = 'Febrero';break;
			case 3:$nmes = 'Marzo';break;
			case 4:$nmes = 'Abril';break;
			case 5:$nmes = 'Mayo';break;
			case 6:$nmes = 'Junio';break;
			case 7:$nmes = 'Julio';break;
			case 8:$nmes = 'Agosto';break;
			case 9:$nmes = 'Septiembre';break;
			case 10:$nmes = 'Octubre';break;
			case 11:$nmes = 'Noviembre';break;
			case 12:$nmes = 'Diciembre';break;
		}
		$listmes['DATA'][$i]['id_mes'] = substr($fecha, 0,4).substr($fecha, 5,2);
		$listmes['DATA'][$i]['descripcion_mes'] = $nmes . " - " . substr($fecha, 0,4);
	}
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          	<div class="col-sm-6">
            	<h1 class="m-0 text-dark">ESTADISTICAS</h1>
          	</div><!-- /.col -->
          	<div class="col-sm-6">
            	<ol class="breadcrumb float-sm-right">
              		<li class="breadcrumb-item"><a href="#">Inicio</a></li>
              		<li class="breadcrumb-item active">Estadsticas</li>
            	</ol>
          	</div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div id="subcontent" class="content">
	<div class="container-fluid">
	    <div class="row">
	    	<div class="col-12">
	            <div class="card">
	            	<div class="card-header">
	            		<div class="row">
		            		<div class="col align-self-start">
		            			<h3 class="card-title" style="height: calc(2.25rem + 2px);line-height: 1.5;padding: .375rem 0 .75rem 0;">EMISIONES</h3>
		            		</div>
		            		<div class="col col-3 align-self-end">
		            			<select class="form-control">
		            				<?php foreach ($listmes['DATA'] as $list): ?>
		            					<option value="<?= $list['id_mes'] ?>"><?= $list['descripcion_mes'] ?></option>
		            				<?php endforeach ?>
		            			</select>
		            		</div>
		            	</div>
	            	</div>
	              	<div class="card-body">
	              		<div class="row">
	              			<div class="col">
		              			<div class="row">
		              				<div class="col text-center">
		              					<h5><?= $facturaCOUNT+$boletaCOUNT+$notascreditoCOUNT+$notasdebitoCOUNT+$proformaCOUNT+$guiaremisionCOUNT ?></h5>
		              					<h6>Comprobantes emitidos</h6>
		              				</div>
		              			</div>
		              			<div class="row mt-1">
		              				<div class="col bg-light form-control-sm">
		              					<div class="row">
			              					<div class="col-8">
			              						<span>Fecturas</span>
			              					</div>
			              					<div class="col-4 text-right">
			              						<span><?= $facturaCOUNT ?></span>
			              					</div>
		              					</div>
		              				</div>
		              			</div>
		              			<div class="row mt-1">
		              				<div class="col bg-light form-control-sm">
		              					<div class="row">
			              					<div class="col-8">
			              						<span>Boletas de venta</span>
			              					</div>
			              					<div class="col-4 text-right">
			              						<span><?= $boletaCOUNT ?></span>
			              					</div>
		              					</div>
		              				</div>
		              			</div>
		              			<div class="row mt-1">
		              				<div class="col bg-light form-control-sm">
		              					<div class="row">
			              					<div class="col-8">
			              						<span>Notas de credito</span>
			              					</div>
			              					<div class="col-4 text-right">
			              						<span><?= $notascreditoCOUNT ?></span>
			              					</div>
		              					</div>
		              				</div>
		              			</div>
		              			<div class="row mt-1">
		              				<div class="col bg-light form-control-sm">
		              					<div class="row">
			              					<div class="col-8">
			              						<span>Notas de debito</span>
			              					</div>
			              					<div class="col-4 text-right">
			              						<span><?= $notasdebitoCOUNT ?></span>
			              					</div>
		              					</div>
		              				</div>
		              			</div>
		              			<div class="row mt-1">
		              				<div class="col bg-light form-control-sm">
		              					<div class="row">
			              					<div class="col-8">
			              						<span>Proforma</span>
			              					</div>
			              					<div class="col-4 text-right">
			              						<span><?= $proformaCOUNT ?></span>
			              					</div>
		              					</div>
		              				</div>
		              			</div>
		              			<div class="row mt-1">
		              				<div class="col bg-light form-control-sm">
		              					<div class="row">
			              					<div class="col-8">
			              						<span>Guias de remision</span>
			              					</div>
			              					<div class="col-4 text-right">
			              						<span><?= $guiaremisionCOUNT ?></span>
			              					</div>
		              					</div>
		              				</div>
		              			</div>
		              		</div>
		              		<div class="col">
					            <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
		              		</div>
		              	</div>
	              	</div>
	            </div>
	    	</div>
	    </div>
	    <div class="row">
	    	<div class="col-12">
	            <div class="card">
	            	<div class="card-header">
	            		<div class="row">
		            		<div class="col align-self-start">
		            			<h3 class="card-title" style="height: calc(2.25rem + 2px);line-height: 1.5;padding: .375rem 0 .75rem 0;">VENTAS</h3>
		            		</div>
		            		<div class="col col-3 align-self-end">
		            			<select class="form-control">
		            				<?php foreach ($listmes['DATA'] as $list): ?>
		            					<option value="<?= $list['id_mes'] ?>"><?= $list['descripcion_mes'] ?></option>
		            				<?php endforeach ?>
		            			</select>
		            		</div>
		            	</div>
	            	</div>
	              	<div class="card-body">
	              		<div class="row">
	              			<div class="col">
	              				<canvas class="chart" id="line-chart-ventas" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
		              		</div>
		              	</div>
	              	</div>
	            </div>
	    	</div>
	    </div>
	    <!--<div class="row">
	    	<div class="col-12">
	            <div class="card">
	            	<div class="card-header">
	            		<div class="row">
		            		<div class="col align-self-start">
		            			<h3 class="card-title" style="height: calc(2.25rem + 2px);line-height: 1.5;padding: .375rem 0 .75rem 0;">COMPRAS</h3>
		            		</div>
		            		<div class="col col-3 align-self-end">
		            			<select class="form-control">
		            				<?php foreach ($listmes as $list): ?>
		            					<option><?=$list?></option>
		            				<?php endforeach ?>
		            			</select>
		            		</div>
		            	</div>
	            	</div>
	              	<div class="card-body">
	              		<div class="row">
	              			<div class="col">
	              				<canvas class="chart" id="line-chart-compras" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
		              		</div>
		              	</div>
	              	</div>
	            </div>
	    	</div>
	    </div>-->
	</div>
</div>
<script>
  $(function () {
  	var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
  	var donutData        = {
      labels: [
          'Factura', 
          'Boleta',
          'Credito', 
          'Debito', 
          'Proforma', 
          'Guias', 
      ],
      datasets: [
        {
          data: [<?= $facturaCOUNT ?>,<?= $boletaCOUNT ?>,<?= $notascreditoCOUNT ?>,<?= $notasdebitoCOUNT ?>,<?= $proformaCOUNT ?>,<?= $guiaremisionCOUNT ?>],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
  	var donutChart = new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions      
    })
  	var salesGraphChartCanvas = $('#line-chart-ventas').get(0).getContext('2d');
  	var salesGraphChartData = {
	    labels  : ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'],
	    datasets: [
	      {
	        label               : 'Soles',
	        fill                : false,
	        borderWidth         : 2,
	        lineTension         : 0,
	        spanGaps : true,
	        borderColor         : '#3498DB',
	        pointRadius         : 3,
	        pointHoverRadius    : 7,
	        pointColor          : '#000000',
	        pointBackgroundColor: '#ffffff',
	        data                : [26.7, 27.8, 49.1, 37.7, 68.1, 56.7, 48.2, 150.7, 106.9, 84.3, 26.7, 27.8, 49.1, 37.7, 68.1, 56.7, 48.2, 150.7, 106.9, 84.3, 26.7, 27.8, 49.1, 37.7, 68.1, 56.7, 48.2, 150.7, 106.9, 84.3, 0.0]
	      }
	    ]
	}
	var salesGraphChartOptions = {
	    maintainAspectRatio : false,
	    responsive : true,
	    legend: {
	      display: false,
	    },
	    scales: {
	      xAxes: [{
	        ticks : {
	          fontColor: '#000000',
	        },
	        gridLines : {
	          display : false,
	          color: '#CACFD2',
	          drawBorder: false,
	        }
	      }],
	      yAxes: [{
	        ticks : {
	          stepSize: 50,
	          fontColor: '#000000',
	        },
	        gridLines : {
	          display : true,
	          color: '#CACFD2',
	          drawBorder: false,
	        }
	      }]
	    }
	}
  	var salesGraphChart = new Chart(salesGraphChartCanvas, { 
	      type: 'line', 
	      data: salesGraphChartData, 
	      options: salesGraphChartOptions
	    }
	)
  	/*var salesGraphChartCanvas = $('#line-chart-compras').get(0).getContext('2d');*/
  	var salesGraphChartData = {
	    labels  : ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'],
	    datasets: [
	      {
	        label               : 'Soles',
	        fill                : false,
	        borderWidth         : 2,
	        lineTension         : 0,
	        spanGaps : true,
	        borderColor         : '#3498DB',
	        pointRadius         : 3,
	        pointHoverRadius    : 7,
	        pointColor          : '#000000',
	        pointBackgroundColor: '#ffffff',
	        data                : [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0]
	      }
	    ]
	}
	var salesGraphChartOptions = {
	    maintainAspectRatio : false,
	    responsive : true,
	    legend: {
	      display: false,
	    },
	    scales: {
	      xAxes: [{
	        ticks : {
	          fontColor: '#000000',
	        },
	        gridLines : {
	          display : false,
	          color: '#CACFD2',
	          drawBorder: false,
	        }
	      }],
	      yAxes: [{
	        ticks : {
	          stepSize: 50,
	          fontColor: '#000000',
	        },
	        gridLines : {
	          display : true,
	          color: '#CACFD2',
	          drawBorder: false,
	        }
	      }]
	    }
	}
  	var salesGraphChart = new Chart(salesGraphChartCanvas, { 
	      type: 'line', 
	      data: salesGraphChartData, 
	      options: salesGraphChartOptions
	    }
	)
})
</script>