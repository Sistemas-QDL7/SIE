<?php
    ob_start();
     session_start();
    
     if (!isset($_SESSION['rol']) || !in_array($_SESSION['rol'], [1, 2,  3])){
        header('Location: ../usuarios/error.php?error=No tienes permisos para acceder a esta página');
        //exit;
//}
    $id=$_SESSION['id'];
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../backend/css/admin.css">
    <link rel="icon" type="image/png" sizes="96x96" href="../../backend/img/ico.svg">
    



    <title>   SIE QDL | Información del colaborador</title>
</head>
<body>

<!-- SIDEBAR -->
<section id="sidebar">
        <a href="../admin/escritorio.php" class="brand">   SIE QDL</a>
        <ul class="side-menu">
            <li><a href="../admin/escritorio.php" class="active"><i class='bx bxs-dashboard icon' ></i> Resumen</a></li>
            <li class="divider" data-text="main">Main</li>
            <li>
                <a href="#"><i class='bx bxs-book-alt icon' ></i> Consultas <i class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                    <li><a href="../citas/mostrar.php">Todas las Consultas</a></li>
                    <li><a href="../citas/nuevo.php">Nueva</a></li>
                    
                   
                </ul>
            </li>

            <li>
                <a href="#"><i class='bx bxs-user icon' ></i> Colaboradores <i class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                    <li><a href="../pacientes/mostrar.php">Lista de Colaboradores</a></li>
                    <li><a href="../pacientes/nuevo.php">Nuevo</a></li>
                    <?php if (in_array($_SESSION['rol'], [1, 2])): ?>
                    <li><a href="../pacientes/historial.php">Historial</a></li>
                    <li><a href="../pacientes/documentos.php">Documentos</a></li>
                    <?php endif; ?>
                   
                </ul>
            </li>
            <?php if (in_array($_SESSION['rol'], [1])): ?>            
            <li>
                <a href="#"><i class='bx bxs-briefcase icon' ></i> Personal <i class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                    <li><a href="../medicos/mostrar.php">Lista de Personal</a></li>
                    <li><a href="../medicos/historial.php">Historial de los Personal</a></li>
                   
                </ul>
            </li>
            

            <li>
                <a href="#"><i class='bx bxs-user-pin icon' ></i> Recursos <i class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                    <li><a href="../recursos/enfermera.php">Enfermera</a></li>
                    <li><a href="../recursos/laboratiorios.php">Servicios de atención</a></li>
                    
                </ul>
            </li>

            <li>
                <a href="#"><i class='bx bxs-diamond icon' ></i> Usuarios<i class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                    <li><a href="../actividades/mostrar.php">Lista de Usuarios</a></li>
                    <li><a href="../actividades/nuevo.php">Nuevo usuario</a></li>
                   
                </ul>
            </li>
            <?php endif; ?>
            <li>
                <a href="#"><i class='bx bxs-spray-can icon' ></i> Medicamentos<i class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                <?php if (in_array($_SESSION['rol'], [1, 2])): ?>
                    <li><a href="../medicinas/venta.php">Entregado por Consultas</a></li>
                    <li><a href="../medicinas/mes.php">Entregado por Mes</a></li>
                    <?php endif; ?>
                    <li><a href="../medicinas/mostrar.php">Listado</a></li>
                    <li><a href="../medicinas/nuevo.php">Nueva</a></li>
                    <li><a href="../medicinas/categoria.php">Categoria</a></li>

                </ul>
            </li>

            <li>
                <a href="#"><i class='bx bx-run icon' ></i> Accidentes<i  class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                <li><a href="../accidentes/mostrar.php">Listado de accidentes</a></li>
                    <li><a href="../accidentes/nuevo.php">Registrar accidentes</a></li>
                    <?php if (in_array($_SESSION['rol'], [1])): ?>
                    <li><a href="../recursos/laboratiorios.php">Servicios de atención</a></li>
                    <?php endif; ?>
                </ul>

            </li>

            <li>
                <a href="#"><i class='bx bxs-user-check icon' ></i> Examenes Internos<i  class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                <li><a href="../examenes/mostrar.php">Listado de examenes</a></li>
                    <li><a href="../examenes/nuevo.php">Registrar examen</a></li>
                </ul>

            </li>

            <li>
                <a href="#"><i class='bx bxs-user-x icon' ></i> Incapacidades<i  class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                <li><a href="../incapacidades/mostrar.php">Listado de incapacidades</a></li>
                    <li><a href="../incapacidades/nuevo.php">Registrar incapacidades</a></li>
                </ul>

            </li>

            <li>
                <a href="#"><i class='bx bx-shield-quarter icon' ></i> Material<i  class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                <li><a href="../material/mostrar.php">Listado</a></li>
                    <li><a href="../material/nuevo.php">Registrar entrega</a></li>
                </ul>

            </li>

            <li>
                <a href="#"><i class='bx bxs-user-detail icon' ></i> Colaboradores derivados<i  class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                <li><a href="../derivados/mostrar.php">Listado</a></li>
                    <li><a href="../derivados/nuevo.php">Registrar</a></li>
                </ul>

            </li>
            <?php if (in_array($_SESSION['rol'], [1])): ?>
            <li>
                <a href="#"><i class='bx bx-plus-medical icon' ></i> Examenes Medicos<i  class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                <li><a href="../examenes_medicos/mostrar.php">Listado</a></li>
                    <li><a href="../examenes_medicos/nuevo.php">Registrar</a></li>
                </ul>

            </li>

            <li>
                <a href="#"><i class='bx bxs-cog icon' ></i> Ajustes<i class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                    <li><a href="../ajustes/mostrar.php">Ajustes</a></li>
                    <li><a href="../ajustes/idioma.php">Idioma</a></li>
                    <li><a href="../ajustes/base.php">Base de datos</a></li>
                    <li><a href="../ajustes/formatos.php">Formatos</a></li>
                    
                </ul>
            </li>

            <li><a href="../acerca/mostrar.php"><i class='bx bxs-info-circle icon' ></i> Acerca de</a></li>
            <?php endif; ?>
        </ul>

    </section>
    <!-- SIDEBAR -->

    <!-- NAVBAR -->
    <section id="content">

        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu toggle-sidebar' ></i>
            <form action="#">
                <div class="form-group">
                    <input type="text" placeholder="Search...">
                    <i class='bx bx-search icon' ></i>
                </div>
            </form>
            
           
            <span class="divider"></span>
            <div class="profile">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQAUqRSSeB-qxBHux7Hn4hsf94d1-nBkT6XmQ&s/neu.png" alt="">
                <ul class="profile-link">
             <li><a href="../profile/mostrar.php"><i class='bx bxs-user-circle icon' ></i> Profile</a></li>
                    
                    <li>
                     <a href="../salir.php"><i class='bx bxs-log-out-circle' ></i> Logout</a>
                    </li>
                   
                </ul>
            </div>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->

        <main>
            <h1 class="title">Bienvenido <?php echo '<strong>'.$_SESSION['name'].'</strong>'; ?></h1>
            <ul class="breadcrumbs">
                <li><a href="../admin/escritorio.php">Home</a></li>
                <li class="divider">></li>
                <li><a href="../pacientes/mostrar.php">Listado de los colaboradores</a></li>
                <li class="divider">></li>
                <li><a href="#" class="active">Información del colaborador</a></li>
            </ul>
           
           <!-- multistep form -->
<?php 
require '../../backend/bd/Conexion.php';
 $id = $_GET['id'];
 $sentencia = $connect->prepare("SELECT * FROM patients  WHERE idpa= '$id';");
 $sentencia->execute();

$data =  array();
if($sentencia){
  while($r = $sentencia->fetchObject()){
    $data[] = $r;
  }
}
   ?>
   <?php if(count($data)>0):?>
        <?php foreach($data as $d):?>
<form action="" enctype="multipart/form-data" method="POST"  autocomplete="off" onsubmit="return validacion()">
  <div class="containerss">
    <h1>Información del colaborador</h1>

    <hr>

    <label for="email"><b># Colaborador</b></label><span class="badge-warning">*</span>
    <input type="text" disabled placeholder="ejm: ASCS855CS74" value="<?php echo $d->numhs; ?>" name="nhi" maxlength="14" required>

    <label for="psw"><b>Nombre del Colaborador</b></label><span class="badge-warning">*</span>
    <input type="text" disabled placeholder="ejm: Juan Raul" value="<?php echo $d->nompa; ?>" name="namp" required>

    <label for="psw"><b>Apellido del Colaborador</b></label><span class="badge-warning">*</span>
    <input type="text" disabled placeholder="ejm: Ramirez Requena" value="<?php echo $d->apepa; ?>" name="apep" required>

    <!--<label for="psw"><b>Dirección del Colaborador</b></label><span class="badge-warning">*</span>
    <input type="text" disabled placeholder="ejm: calle los medanos" value="<?php //echo $d->direc; ?>" name="dip" required>-->

    <label for="psw"><b>Género del Colaborador</b></label><span class="badge-warning">*</span>
    <select required name="gep" id="gep" disabled>
        <option><?php echo $d->sex; ?></option>
        
    </select>

    <label for="psw"><b>Área</b></label><span class="badge-warning">*</span>
    <select required name="grp" id="grp" disabled>
        <option><?php echo $d->grup; ?></option>
       
    </select>

    <!--<label for="psw"><b>Teléfono del colaborador</b></label><span class="badge-warning">*</span>
    <input type="text" disabled maxlength="13" value="<?php // echo $d->id_area; ?>"  placeholder="ejm: +51 999 888 111" name="telp" required>-->

    <label for="psw"><b>Fecha de registro</b></label><span class="badge-warning">*</span>
    <input type="datetime-local" disabled  value="<?php echo $d->fere; ?>" name="cump" required>

    <label for="psw"><b>Fecha de modificación</b></label><span class="badge-warning">*</span>
    <input type="datetime-local" disabled value="<?php echo $d->cump; ?>" name="corr" required>

    <!-- <label for="psw"><b>Usuario del colaborador</b></label><span class="badge-warning">*</span>
    <input type="text" disabled value="<?php //echo $d->username; ?>" name="username" required> -->

    <hr>
   
   
  </div>
  
</form>

        <?php endforeach; ?>
  
    <?php else:?>
      <p class="alert alert-warning">No hay datos</p>
    <?php endif; ?>
        </main>
        <!-- MAIN -->
    </section>
    <script src="../../backend/js/jquery.min.js"></script>
    <script src="../../backend/js/script.js"></script>
    

   
</body>
</html>


