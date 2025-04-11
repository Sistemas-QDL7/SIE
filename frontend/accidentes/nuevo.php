<?php
    ob_start();
    session_start();
    


    
    if (!isset($_SESSION['rol']) || !in_array($_SESSION['rol'], [1, 2,  3])){
        header('Location: ../usuarios/error.php?error=No tienes permisos para acceder a esta página');
    }

    $id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../backend/css/admin.css">
    <link rel="icon" type="image/png" sizes="96x96" href="../../backend/img/ico.svg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">

    <title>   SIE QDL | Nuevo Accidente</title>

    <style>
        .autocomplete-results {
            border: 1px solid #ccc;
            max-height: 200px;
            overflow-y: auto;
            position: absolute;
            z-index: 1000;
            background-color: #fff;
            width: calc(100% - 2px);
            box-sizing: border-box;
        }

        .autocomplete-item {
            padding: 8px;
            cursor: pointer;
        }

        .autocomplete-item:hover {
            background-color: #f0f0f0;
        }
    </style>
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
        <nav>
            <i class='bx bx-menu toggle-sidebar'></i>
            <form action="#">
                <div class="form-group">
                    <input type="text" placeholder="Search...">
                    <i class='bx bx-search icon'></i>
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
                <li><a href="../accidentes/mostrar.php">Listado de los Accidentes</a></li>
                <li class="divider">></li>
                <li><a href="#" class="active">Registrar accidente</a></li>
            </ul>

            <!-- multistep form -->
            <form action="../../backend/php/add_accident.php" enctype="multipart/form-data" method="POST" autocomplete="off">
                <div class="containerss">
                    <h1>Registrar accidente</h1>
                    <div class="alert-danger">
                        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                        <strong>Importante!</strong> Es importante rellenar los campos con &nbsp;<span class="badge-warning">*</span><br>
                    </div>
                    <hr>
                    <br>
                    <label for="email"><b>Fecha y Hora</b></label><span class="badge-warning">*</span>
                    <input type="datetime-local" name="fecha" required min="1975-01-01T00:00" max="<?php echo date('Y-m-d\TH:i'); ?>">

                    <label for="psw"><b>Número de control del colaborador</b></label><span class="badge-warning">*</span>
                    <input type="text" id="searchBox" name="num_control" placeholder="Buscar por número de control" autocomplete="off">
                    <div id="results" class="autocomplete-results"></div>

                    <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const searchBox = document.getElementById('searchBox');
                        const resultsDiv = document.getElementById('results');

                        searchBox.addEventListener('input', function() {
                            const searchTerm = searchBox.value;

                            if (searchTerm.length >= 1 && searchTerm.length <= 5) { // Empieza la búsqueda después de al menos 2 caracteres
                                fetch(`search.php?term=${encodeURIComponent(searchTerm)}`)
                                    .then(response => response.json())
                                    .then(data => {
                                        //Filtrar los resultados para que solo se muestren los que coinciden  con el término de búsqueda
                                        const filteredData = data.filter((item => item.numhs.startsWith(searchTerm)));

                                        //Ordenar los resultados por la longitud del número de control
                                        filteredData.sort((a, b) => a.numhs.length - b.numhs.length);
                                        resultsDiv.innerHTML = '';

                                        data.forEach(item => {
                                            const resultItem = document.createElement('div');
                                            resultItem.classList.add('autocomplete-item');
                                            resultItem.textContent = `${item.nompa} ${item.apepa} (Número de control: ${item.numhs})`;
                                            resultItem.dataset.numhs = item.numhs;

                                            resultItem.addEventListener('click', function() {
                                                searchBox.value = item.numhs;
                                                resultsDiv.innerHTML = '';
                                            });

                                            resultsDiv.appendChild(resultItem);
                                        });
                                    });
                            } else {
                                resultsDiv.innerHTML = '';//Limpiar los resultados si no está en el rango
                            }
                        });
                    });
                    </script>

                    <label for="email"><b>Tipo de Lesión</b></label><span class="badge-warning">*</span>
                    <textarea name="lesion" maxlength="255" style="height:200px" placeholder="Tipo de Lesión..."></textarea>

                    <label for="email"><b>Días de incapacidad</b></label><span class="badge-warning">*</span>
                    <input type="text" name="incapacidad" pattern="\d*" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required="" placeholder="Cantidad de dias de incapacidad...">


                    <label for="email"><b>Mecanismo del accidente</b></label><span class="badge-warning">*</span>
                    <textarea name="mecanismo_accidente" maxlength="255" style="height:200px" placeholder="Mecanismo del accidente..."></textarea>

                    <label for="psw"><b>Servicio de atención</b></label><span class="badge-warning">*</span>
                    <select required name="applab" id="lab">
                        <option>Seleccione</option>
                    </select>
                    <hr>
                    <button type="submit" name="add_accident" class="registerbtn">Guardar</button>
                </div>
            </form>
        </main>
        <!-- MAIN -->
    </section>
    <script src="../../backend/js/jquery.min.js"></script>
    <script src="../../backend/js/script.js"></script>
    <script src="../../backend/js/multistep.js"></script>
    <script src="../../backend/js/vpat.js"></script>
    <script src="../../backend/js/patiens.js"></script>
    <script src="../../backend/js/doctor.js"></script>
    <script src="../../backend/js/laboratory.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <?php include_once '../../backend/php/add_accident.php' ?>
</body>
</html>