<?php
    ob_start();
     session_start();
    
    if (!isset($_SESSION['rol']) || !in_array($_SESSION['rol'], [1, 2])) {
        header('Location: ../usuarios/error.php?error=No tienes permisos para acceder a esta página');

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
    



    <title>   SIE QDL | Documentos del colaborador</title>
</head>
<body>

    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="../admin/escritorio.php" class="brand">SIE QDL</a>
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
                <?php if (in_array($_SESSION['rol'], [1])): ?>
                    <li><a href="../profile/mostrar.php"><i class='bx bxs-user-circle icon' ></i> Profile</a></li>
                    <?php endif; ?>
                    <li>
                     <a href="../salir.php"><i class='bx bxs-log-out-circle' ></i> Cerrar Sesión</a>
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
                <li><a href="../pacientes/documentos.php">Documentos de los colaboradores</a></li>
                <li class="divider">></li>
                <li><a href="#" class="active">Nuevo documento</a></li>
            </ul>
           <br>

           <?php 
require '../../backend/bd/Conexion.php';
 $id = $_GET['id'];
 $sentencia = $connect->prepare("SELECT * FROM patients INNER JOIN empresas ON patients.id_empresa = empresas.id_empresa  WHERE idpa= '$id';");
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
<div class="input-block">

                    <div class="wrap-line">

                                <!-- Inputs -->
        <div class="brise-input">
            
            <input type="text" value="<?php echo $d->numhs; ?>" name="text" required>
            
            <span class="line"></span>
        </div>
        <div class="brise-input">
            
            <input type="text" value="<?php echo $d->nompa; ?>" name="text" required>
           
            <span class="line"></span>
        </div>

                <!-- Inputs -->
        <div class="brise-input">
            
            <input type="text" value="<?php echo $d->apepa; ?>" name="text" required>
            
            <span class="line"></span>
        </div>
        <div class="brise-input">
           
            <input type="text" value="<?php echo $d->nombre_empresa; ?>" name="text" required>
            
            <span class="line"></span>
        </div>

        <div class="brise-input">
          
            <input type="text" value="<?php echo $d->cump; ?>" name="text" required>
            
            <span class="line"></span>
        </div>


        <div class="brise-input">
          
            <input type="text" value="<?php echo $d->sex; ?>" name="text" required>
            
            <span class="line"></span>
        </div>

                <div class="brise-input">
            
            <input type="text" value="<?php echo $d->grup; ?>" name="text" required>
            
            <span class="line"></span>
        </div>

        <div class="brise-input">
           
            <input type="text" value="<?php echo $d->fere; ?>" name="text" required>
            
            <span class="line"></span>
        </div>
                        
                    </div>

</div>


<div class="data">
    <div class="content-data">
        <div class="head">
            <h3>Nuevo documento</h3>
                  <div class="botonsa-modals">
        <label for="btnsa-modals">
            Nuevo
        </label>
    </div>         
        </div>
<div class="flexbox">
        <ul class="flex-card-list">
             <?php 
$id = $_GET['id'];
 $sentencia = $connect->prepare("SELECT * FROM document  WHERE idpa= '$id';");
 $sentencia->execute();

$data =  array();
if($sentencia){
  while($r = $sentencia->fetchObject()){
    $data[] = $r;
  }
}

 ?>
 <?php if (count($data) > 0): ?>
    <?php foreach ($data as $e): ?> 
        <li class="flex-card-listitem">
            <div class="flex-card">
                <div class="flex-card-image">
                    <?php 
                    // Detectar la extensión del archivo
                    $fileExtension = strtolower(pathinfo($e->foto, PATHINFO_EXTENSION));
                    if (in_array($fileExtension, ['jpeg', 'jpg', 'png', 'gif'])): 
                    ?>
                        <!-- Mostrar imagen -->
                        <img src="../../backend/files/subidas/<?php echo $e->foto; ?>" alt="<?php echo $e->nomfi; ?>" />
                    <?php elseif ($fileExtension === 'pdf'): ?>
                        <!-- Mostrar un visor de PDF -->
                        <embed src="../../backend/files/subidas/<?php echo $e->foto; ?>" type="application/pdf" width="100%" height="300px" />
                    <?php else: ?>
                        <!-- Mostrar un ícono genérico -->
                        <img src="../../path-to-icons/file-icon.png" alt="Archivo" />
                    <?php endif; ?>
                </div>
                <div class="flex-card-content">
                    <!-- Mostrar el nombre del archivo -->
                    <p><strong>Descripción:</strong> <?php echo $e->nomfi; ?></p>
                    <a href="../../backend/files/subidas/<?php echo $e->foto; ?>" class="flex-card-button" download>Download</a>
                </div>
            </div>
        </li>
    <?php endforeach; ?>
<?php else: ?>
    <p class="alert alert-warning">No existe ningún documento</p>
<?php endif; ?>


        </ul>
      </div>

    </div>
</div>



        <?php endforeach; ?>
  
    <?php else:?>
      <p class="alert alert-warning">No hay datos</p>
    <?php endif; ?>


        </main>
        <!-- MAIN -->
    </section>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <!-- NAVBAR -->
    
    <script src="../../backend/js/script.js"></script>
    <script src="../../backend/js/multistep.js"></script>
    <script src="../../backend/js/vpat.js"></script>
    


<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include_once '../../backend/modal/md_docu.php' ?>
<?php include_once '../../backend/php/add_docu.php' ?>


</body>
</html>