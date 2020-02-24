<?php
  session_start();
  $balonDATA = $_SESSION['balonDATA'];
  $id_bal =$balonDATA['DATA'][0]['id_bal'];
?>
<input type="hidden" id="id_bal" value="<?= $id_bal ?>">
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">BALONES</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                  <li class="breadcrumb-item active">Balones</li>
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
                  <div class="col-12">
                    <h3 class="card-title"><?= $balonDATA['DATA'][0]['nombre_bal'] ?></h3>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <div class="form-group row">
                        <label class="form-control-label col-2">Cantidad</label>
                        <div class="col-10">
                          <input id="cantidad" type="number" class="form-control">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <button onclick="listarCodeBar($('#cantidad').val())" class="btn btn-primary">Agregar</button>
                    </div>
                  </div>
                  <div class="row">
                    <div id="contentBarCode" class="col m-3" style="min-height: 10vh; border: 1px solid #000">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <button class="btn btn-info btn-block" onclick="javascript:imprim1();">INPRIMIR</button>
                    </div>
                    <div class="col">
                      <button class="btn btn-secondary btn-block" onclick="listarCodeBar(0)">LIMPIAR</button>
                    </div>
                  </div>
                </div>
              </div>
        </div>
      </div>
  </div>
</div>
<table>
<script>
  function listarCodeBar(cantidad) {
    fetch('../controllers/balonController.php?op=20&id_bal=<?= $id_bal ?>&cantidad='+cantidad)
    .then(res => res.json())
    .then(data => {
      if (data.STATUS == 'OK') {
        var contenido = '';
        for (var i in data.DATA) {
          contenido += `
            <div class="text-center p-2">
              <img src='../dist/img/balon/${data.DATA[i].codbar_balxu}.png'><br>
              <span>${data.DATA[i].codbar_balxu}</span>
            </div>
          `;
        }
        $('#contentBarCode').html(contenido);
      }
    })
  }
function imprim1(){
  var printContents = document.getElementById('contentBarCode').innerHTML;
    w = window.open();
    w.document.write(printContents);
    w.document.close(); // necessary for IE >= 10
    w.focus(); // necessary for IE >= 10
    w.print();
    w.close();
    return true;
  }
</script>
</script>
