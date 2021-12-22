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
<script type="text/javascript">
	var i=1;
	function agregar(src){
	i++;
	src.innerHTML+='<i class="fa fa-rocket icon"></i><label>Actividad#'+i+': </label><input type="text" class="input-field" name="act_'+i+'" size="20" maxlength="200" pattern="[A-Z a-z 0-9]{5,200}"><br><br>';
	}
	var it = i;
</script>
<script type="text/javascript" src="../../public/js/act.js"></script>
</head>

<body>
<center>
    <div class="contenedor">
    	<section class="login-box">
			<form method="POST" action="<?php echo htmlspecialchars('../reg_tar.php');?>" autocomplete="off">
			<h2>ASIGNACIÓN DE ACTIVIDADES</h2>
				<div class="input-container">
					<i class="fa fa-rocket icon"></i>
		            <select type="email" name="nom_pro" id="nom_pro" required>
		            	<option value = "">Proyectos:</option>
		                	<?php
                                include '../../models/conexion2.php';
                                $varss = $_SESSION['usuario'];
								$c_pro = $conexion->query("SELECT ID_P, Nombre_P FROM proyecto WHERE Lider='$varss'");
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

				<div class="input-container" id="user_rel"></div>

                    <script type="text/javascript">
                            $(document).ready(function(){
                                recargarL();

                                $('#nom_pro').change(function(){
                                    recargarL();
                                });
                            })
                        </script>
                        <script type="text/javascript">
                            function recargarL(){
                                $.ajax({
                                    type:"POST",
                                    url:"../cbxd_pro_usrel.php",
                                    data:"nom_pro=" + $('#nom_pro').val(),
                                    success:function(r){
                                        $('#user_rel').html(r);
                                    }
                                });
                            }
                        </script>

				<div id="generado" class="input-container">
					<i class="fa fa-pencil-square-o icon"></i>
					<input type="text" placeholder="Actividad:" size="20" name="act_1" maxlength="200" pattern="[A-Z a-zñáéíóú .-_:#$ 0-9]{5,200}">
				</div>

                <div id="generado" class="input-container">
					<input type="date" name="fch_act" id="date" required>
				</div>

				<!--<button onclick="agregar(document.getElementById('generado'));return false;">Añadir</button>-->
					<input class="" type="submit" value="Registrar">
					<!--<button type="button" onclick="getData()">Probar</button>-->
<br><br>
          <a href="menu_admin.php">Cancelar</a>
			</form>
		</section>
	</div>
</center>
</body>
</html>
