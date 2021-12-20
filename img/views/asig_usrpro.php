<?php
    session_start();
    error_reporting(0);
	$varss = $_SESSION['usuario'];
	$perf_user = $_SESSION['nom_user'];

	$telf = $_SESSION['telefono'];

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
	<title>Afiliación | Proyecto</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

	<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="../../public/css/rec.css">
	<link rel="shortout icon" type="image/x-icon" href="..\..\public\images\logo.png">
    <script type="text/javascript" src="../../public/js/jquery-3.4.1.min.js"></script>
</head>
<body>
	<div class="contenedor">
		<section class="login-box">
		<center>
		<h1>AFILIA USUARIOS A TUS PROYECTOS PERSONALES</h1>
		<h4>Para invitar usuarios a tus proyectos, ingrese el código del usuario.</h4>
		<form action="<?php echo htmlspecialchars('../invt_user.php');?>" method="POST" autocomplete="off">

            <div class="input-container">
                <i class="fa fa-rocket icon"></i>
                <select type="email" name="nom_pro" id="nom_pro" required>
                    <option value = "">Proyectos:</option>
                        <?php
                            include '../../models/conexion2.php';
                            $varss = $_SESSION['usuario'];
                            $c_pro = $conexion->query("SELECT Nombre_P FROM proyecto WHERE Lider='$varss'");
                            if ($c_pro->num_rows > 0)
                            {
                                $selec_pro = "";
                                while ($row_p = mysqli_fetch_array($c_pro))
                                {
                                    $selec_pro .="<option value='".$row_p['Nombre_P']."'>".$row_p['Nombre_P']."</option>";
                                }
                            }
                            ?>
                            <?php echo $selec_pro; ?>
                </select>
			</div>

			<div class="input-container">
				<i class="fa fa-barcode icon"></i>
				<input type="text" class="input-field" name="cduser" placeholder="Código de usuario:" title="Ingresa un código valido" maxlength="8" pattern="[A-Z a-zñáéíóú .-_:#$ 0-9]{8,8}" required>
			</div>
			<input type="submit" class="boton" value="Invitar">
			</form>
			<a href="menu_admin.php">Cancelar</a>
		</center>
	    </section>
	</div>
</body>
</html>
