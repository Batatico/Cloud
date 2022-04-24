<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="shortcut icon" href="images/ucn.ico" type="image/x-icon">
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-migrate-3.3.2.js"></script>
        <script src="https://code.jquery.com/jquery-3.0.0.js"></script>
        <title>Plataforma Ayudantes</title>
    </head>   
    
    <!-- Barra de navegación que muestra logo, opciones como webmail, servicios, telefonos ucn, plataforma etc. -->

<body>

  <nav class ="navbar navbar-light navbar-expand-md fixed-top" style ="background-color: #003057"  >
    <div class="container" >
     <a href="#" class="navbar-brand">
      <img src="images/logo_ucn_fondo_oscuro.png" alt="Logo UCN" width="250px" height="auto">
     </a>
         

     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu-principal" aria-controls="menu-principal" aria-expanded="false" aria-label="Desplegar menú de navegación">
       <span class="navbar-toggler-icon"></span>

     </button>

    <div class="collapse navbar-collapse" id="menu-principal">
      <ul class="navbar-nav" style="margin-left: auto;">
        <li class="nav-item"> <a href="https://ssb.ucn.cl/PROD/twbkwbis.P_WWWLogin" class="nav-link active">Mi Portal</a></li>
        <li class="nav-item"> <a href="https://online.ucn.cl/onlineUcn/" class="nav-link">Online UCN</a></li>
        <li class="nav-item"> <a href="https://www.gmail.com/" class="nav-link">Webmail</a></li>
        <li class="nav-item"> <a href="https://www.ucn.cl/servicios-ucn/" class="nav-link">Servicios</a></li>
        <li class="nav-item"> <a href="http://online.ucn.cl/directoriotelefonicoemail/Default.aspx?ind=func" class="nav-link">Directorio Telefónico</a></li>
        <li class="nav-item"> <a href="https://www.ucn.cl/contacto/" class="nav-link">Contacto</a></li>
        <li class="nav-item"> <a href="https://campusvirtual.ucn.cl/" class= "nav-link">Campus Virtual</a> </li>
      </ul>      
     </div>
    </div>
  </nav> 
  
  <section class="Login py-5 mt-5">
	<!--- Esto existe para separar el título de la nav-bar, sin esto el titulo queda pegado -->
	<div class="container d-flex justify-content-center py-4 mt-5"> 
    <a> <img src="https://i.imgur.com/zrhHEQQ.jpg" width="150" /></a>
    </div>
	<!--- Login -->
	<h2 class= "fw-bold text-center py-4"style="color: black;">Ingreso a la Plataforma</h2>
	
    
    <div class = "container d-flex justify-content-center w-75">

			
			<div class ="col-12">				

				<!--- Login -->

				<form action="#"style="color: black;">

                
                
					<div class="mb-4 d-grid gap-2">
						<label for="RUT" class="form-label"> RUT </label>
						<input type="RUT" class="form" name="RUT">						
					</div>
					<div class="mb-4 d-grid">
						<label for="Password" class="form-label"> Contraseña </label>
						<input type="Password" class="form" name="Password">
					</div>
					<div class="mb-4 form-check">
						<input type="checkbox" name="connected" class="form-check-input" >	
						<label for="coneccted" class="form-check-label">Mantenerme Conectado</label>				
					</div>
					<div class="d-grid gap-2 d-md-block">
						<a href="#" class="btn btn-lg btn-primary"tabindex="-1" role="button" aria-disabled="true" >Iniciar Sesión</a>
						<a href="{{ route("register.index")}}" class="btn btn-lg btn-secondary"tabindex="-1" role="button" aria-disabled="false" >Registrate</a>
						
					</div>
					<div class="my-3">
					<span> <a href="#"> Recuperar Contraseña </a></span> 

					</div>
					
				</form>

				<!--- Login with @UCN/ALUMNOS -->

				<div class="container w-100 my-5">
					<div class="row text-center">
						<div class="col">Iniciar Sesión con cuenta UCN</div>
					</div>
					<div class="row text-center my-4">
						<div class ="col-12 d-grid gap-2 d-md-block">
							<a href="#" class="btn btn-lg btn-outline-danger text center"tabindex="-1" role="button" aria-disabled="false"> <img src="Images/Google.png" width="32" alt=""> Google </a>						
						</div>
					</div>
				</div>
			</div>
		</div>		
   </div>
</section>

</body>
</html>


    

