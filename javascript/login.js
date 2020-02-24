var frmLogin = document.getElementById("frmLogin");
frmLogin.addEventListener('submit', function(e) {
	e.preventDefault();
	var data = new FormData(frmLogin);
	fetch('../controllers/loginController.php',{
	    method: 'POST',
	    body: data
	})
	.then(res => res.json())
    .then(data => {
        console.log(data);
        if (data == 'OK') {
        	window.location="../views/template.php";
        } else {
        	var mensaje = document.getElementById("mensaje");
        	mensaje.innerHTML = `
	            <div class="alert alert-warning alert-dismissible fade show" role="alert">
				  <strong>OH NO!</strong> Usuario o clave incorrectos.
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>
	        `;
        }
    })
})
