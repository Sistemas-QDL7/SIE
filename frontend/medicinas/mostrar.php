<?php
    ob_start();
     session_start();
    
     if (!isset($_SESSION['rol']) || !in_array($_SESSION['rol'], [1, 2,  3])) {
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

    <!-- Data Tables -->
    <link rel="stylesheet" type="text/css" href="../../backend/css/datatable.css">
    <link rel="stylesheet" type="text/css" href="../../backend/css/buttonsdataTables.css">
    <link rel="stylesheet" type="text/css" href="../../backend/css/font.css">




    <title>   SIE QDL | Listado de medicinas</title>
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
                <li><a href="#" class="active">Listado de medicinas</a></li>
            </ul>
            <button class="button" onclick="location.href='nuevo.php'">Nuevo</button>
          <div class="data">
                <div class="content-data">
                    <div class="head">
                        <h3>Medicinas</h3>
                      

                    </div>
                   <div class="table-responsive" style="overflow-x:auto;">
                       <?php 
require '../../backend/bd/Conexion.php';
$sentencia = $connect->prepare("SELECT product.idprcd, product.codpro, product.nompro, category.idcat, category.nomcat, product.preprd, product.stock, product.state, product.fere FROM product INNER JOIN category ON product.idcat = category.idcat ORDER BY idprcd DESC;");
 $sentencia->execute();
$data =  array();
if($sentencia){
  while($r = $sentencia->fetchObject()){
    $data[] = $r;
  }
}
     ?>
     <?php if(count($data)>0):?>
         <table id="example" class="responsive-table">
            <thead>
                <tr>

                    <th scope="col">Código</th>
                    <th scope="col">Medicinas</th>
                    <th scope="col">Categorias</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Foto</th>
                    <!--<th scope="col">Estado</th>-->
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data as $d):?>
                    <tr>
                        <th scope="row"><?php echo $d->codpro ?></th>
                        <td data-title="Medicina"><?php echo $d->nompro ?></td>
                        <td data-title="Categorias"><?php echo $d->nomcat ?></td>
                        <td data-title="Stock"><?php echo $d->stock ?></td>
                        <td data-title="Foto"><img src="../../backend/img/medicine.svg"></td>
                        
                        <!--<td data-title="Estado">
    
                        <label class="switch">
                          <input type="checkbox" id="<?=$d->idprcd?>" value="<?=$d->state ?>" <?=$d->state == '1' ? 'checked' : '' ;?>/> 
                          

                          <span class="slider"></span>
                        </label>
                        </td>-->
                        
                        <td>
                <a title="Actualizar" href="../medicinas/editar.php?id=<?php echo $d->idprcd ?>" class="fa fa-pencil tooltip"></a>
                            <a title="Información" href="../medicinas/info.php?id=<?php echo $d->idprcd ?>" class="fa fa-info"></a>

                            <a title="Stock" href="../medicinas/stock.php?id=<?php echo $d->idprcd ?>" class="fa fa-tag"></a>
                           
                            <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2): ?>
                            <form  onsubmit="return confirm('Realmente desea eliminar el registro?');" method='POST' action='<?php $_SERVER['PHP_SELF'] ?>'>
<input type='hidden' name='idprcd' value="<?php echo  $d->idprcd; ?>">

<button name='delete_medicine' style="cursor: pointer;" class="fa fa-trash"></button>
<?php endif; ?>
</form>

        
                        </td>
                    </tr>
                    <?php endforeach; ?>
            </tbody>
         </table> 
         <?php else:?>
  
    <div class="alert">
      <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
      <strong>¡Advertencia!</strong> No hay datos.
    </div>
    <?php endif; ?>
                    </div>
                </div>
            </div>  

        </main>
        <!-- MAIN -->
    </section>
    
    <!-- NAVBAR -->
    <script src="../../backend/js/jquery.min.js"></script>
    
    <script src="../../backend/js/script.js"></script>
    
    <!-- Data Tables -->
    <script type="text/javascript" src="../../backend/js/datatable.js"></script>
    <script type="text/javascript" src="../../backend/js/datatablebuttons.js"></script>
    <script type="text/javascript" src="../../backend/js/jszip.js"></script>
    <script type="text/javascript" src="../../backend/js/pdfmake.js"></script>
    <script type="text/javascript" src="../../backend/js/vfs_fonts.js"></script>
    <script type="text/javascript" src="../../backend/js/buttonshtml5.js"></script>
    <script type="text/javascript" src="../../backend/js/buttonsprint.js"></script>
    <script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf'
        ]
    } );
} );
    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
 <?php include_once '../../backend/php/delete_medicine.php' ?>
</body>
</html>


