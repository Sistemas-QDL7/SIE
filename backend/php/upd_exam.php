<?php  
if(isset($_POST['upd_exam']))
{

    $nombre =  $_POST['nombre'];
    $status = $_POST['status'];
    $observaciones = $_POST['observaciones'];
    $fecha = $_POST['fecha'];
    $idodc =  $_POST['appdoc'];
    $idex = $_POST['idex'];
    
    try {

        $query = "UPDATE examenes SET nombre=:nombre, status=:status, observaciones=:observaciones, fecha=:fecha, idodc=:idodc WHERE idex=:idex LIMIT 1";
        $statement = $connect->prepare($query);

        $data = [
            ':nombre' => $nombre,
            ':status' => $status,
            ':observaciones' => $observaciones,
            ':fecha' => $fecha,
            ':idodc' => $idodc,
            ':idex' => $idex
        ];
        $query_execute = $statement->execute($data);

        if($query_execute)
        {
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script type="text/javascript">
            swal("¡Actualizado!", "Actualizado correctamente", "success").then(function() {
                        window.location = "../examenes/mostrar.php";
                    });
                    </script>';
            exit(0);
        }
        else
        {
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script type="text/javascript">
            swal("Error!", "Error al actualizar", "error").then(function() {
                        window.location = "../examenes/mostrar.php";
                    });
                    </script>';
            exit(0);
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>