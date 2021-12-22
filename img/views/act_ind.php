<?php
    session_start();
    error_reporting(0);
	$varss = $_SESSION['usuario'];
	$perf_user = $_SESSION['nom_user'];

    if ($varss == null || $varss = '') {
      echo ("<script LANGUAGE='JavaScript'>
      window.alert('Debe iniciar sesión.');
      window.location.href='../../views/login.php';
      </script>");
      die();
    }
?>
<html lang="es">
<head>
	<title>Registro | Actividades</title>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

	<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="../../public/css/regpro.css">
	<link rel="shortout icon" type="image/x-icon" href="..\..\public\images\logo.png">

<script type="text/javascript" src="../../public/js/jquery-3.4.1.min.js"></script>

</head>

<body>
<center>
    <div class="contenedor">
    	<section class="login-box">
			<form method="POST" action="<?php echo htmlspecialchars('../reg_tarind.php');?>" autocomplete="off">
			<h2>REGISTRO DE ACTIVIDADES</h2>
				<div class="input-container">
					<i class="fa fa-rocket icon"></i>
		            <select type="email" name="nom_pro" id="nom_pro" required>
		            	<option value = "">Proyectos:</option>
		                	<?php
                                include '../../models/conexion2.php';
                                $varss = $_SESSION['usuario'];
                                $cd_user = hash('adler32',$varss);
								$c_pro = $conexion->query("SELECT ID_P, Nombre_P FROM proyecto 
                                p INNER JOIN rel_us_pro rsp ON rsp.IDProyecto = p.ID_P
                                INNER JOIN usuarios u ON u.ID_user = rsp.IDUsuario
                                WHERE rsp.IDUsuario = '$cd_user'");
								if ($c_pro->num_rows > 0)
								{
								    $selec_pro = "";
								    while ($row_p = mysqli_fetch_array($c_pro))
								    {
								        $selec_pro .="<option value='".$row_p['ID_P']."'>".$row_p['Nombre_P']."</option>";
								    }
								}
								?>
		                     <?php echo $selec_pro; ?>
		            </select>
				</div>

				<div class="input-container">
					<i class="fa fa-envelope icon"></i>
					<input type="text" name="lider_pro" value="<?php echo $_SESSION['usuario']; ?>" readonly required>
				</div>

				<div id="generado" class="input-container">
					<i class="fa fa-pencil-square-o icon"></i>
					<input type="text" placeholder="Actividad:" name="act_1" maxlength="1000" pattern="[A-Z a-zñáéíóú ,.-_:#$ 0-9]{1,1000}">
				</div>

                <div id="generado" class="input-container">
                    <i class="fa fa-calendar icon"></i>
                    <label>Fecha de finalización:</label>
                </div>

                <div id="generado" class="input-container">
					<input type="date" name="fch_act" id="date" required>
				</div>
					<input class="" type="submit" value="Registrar">
<br><br>
          <a href="menu_admin.php">Cancelar</a>
			</form>
		</section>
	</div>
</center>
</body>
</html>
