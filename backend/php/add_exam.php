<?php 
require_once('../../backend/bd/Conexion.php'); 

if (isset($_POST['add_exam'])) {
    $nombre = trim($_POST['nombre']);//Tipo de lesion
    $status = trim($_POST['status']); // El valor de NUMERO DE CONTROL
    $observaciones = trim($_POST['observaciones']);// Las observaciones del examen
    $fecha = $_POST['fecha'];
    $idodc = trim($_POST['appdoc']);




        // Insertar el evento usando el idpa
        $sql = "INSERT INTO examenes(fecha, nombre, status, observaciones, idodc) 
                VALUES(:fecha, :nombre, :status, :observaciones, :idodc)";
        
        $sql = $connect->prepare($sql);
        $sql->bindParam(':fecha', $fecha);
        $sql->bindParam(':nombre', $nombre);
        $sql->bindParam(':status', $status);
        $sql->bindParam(':observaciones', $observaciones);
        $sql->bindParam(':idodc', $idodc);

        //$sql->execute();

        $lastInsertId = $connect->lastInsertId();
        if ($sql->execute()) {
            
            echo '<script type="text/javascript">
            
            swal("¡Registrado!", "Se resgistro el examen correctamente", "success").then(function() {
                window.location = "../examenes/mostrar.php";
            });
            </script>';
            header('Location: ../../frontend/examenes/mostrar.php');
        } else {
            echo '<script type="text/javascript">
            swal("Error!", "No se pueden agregar datos, comuníquese con el administrador", "error").then(function() {
                window.location = "nuevo.php";
            });
            </script>';
            print_r($sql->errorInfo());
        }
    
}
?>