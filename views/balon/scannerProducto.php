<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          	<div class="col-sm-6">
            	<h1 class="m-0 text-dark">SCANNER DE PRODUCTOS</h1>
          	</div><!-- /.col -->
          	<div class="col-sm-6">
            	<ol class="breadcrumb float-sm-right">
              		<li class="breadcrumb-item"><a href="#">Inicio</a></li>
              		<li class="breadcrumb-item active">Scanner</li>
            	</ol>
          	</div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div id="subcontent" class="content">
    <div class="container-fluid">
        <div class="row" id="scannerContent">
            <div class="col-12" style="height: 80vh;">
              <div class="col-12 text-center" style="margin-top: 20vh;display: flex;justify-content: center;align-items: center;" id="divImgScanner">
                <div style="height: 152px">
                  <span class="fas fa-barcode" style="color: #bbb;font-size: 120px"></span><br>
                  <span style="color: #bbb;display: block;font-size: 24px;line-height: 32px;">Escanea un producto con un lector de código de barras</span>
                  <div class="row">
                    <div class="col-8">
                      <input type="number" class="form-control" id="codbar_balxu" name="codbar_balxu">
                    </div>
                    <div class="col-4">
                      <button onclick="scanner()" class="btn btn-outline-secondary btn-block">VER</button>
                    </div>
                    <div class="col-12" id="msjScanner">
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
<script>
  function scanner() {
    fetch('../controllers/balonController.php?op=18&codbar_balxu='+$('#codbar_balxu').val())
    .then(res => res.json())
    .then(data => {
      if (data.STATUS == 'OK') {
        console.log(data.DATA[0]['count_balxu']);
        if (data.DATA[0]['count_balxu'] > 0) {
          ajaxCompuesto('scannerContent','../controllers/balonController.php',19,'id_balxu='+data.DATA[0]['id_balxu']);
        } else {
          $('#msjScanner').html(`
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>ERROR!</strong> Error al extraer datos. El balon no existe
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          `);
      }
      } else {
        $('#msjScanner').html(`
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>ERROR!</strong> Error al extraer datos.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        `);
      }
    })
  }
</script>