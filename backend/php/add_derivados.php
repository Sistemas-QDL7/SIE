<?php 
require_once('../../backend/bd/Conexion.php'); 

if (isset($_POST['add_derivados'])) {
    $fecha = trim($_POST['fecha']);
    $numhs = trim($_POST['num_control']); // El valor de NUMERO DE CONTROL
    $causa = trim($_POST['causa']);
    $obs = trim($_POST['obs']);
    


    ///////// Buscar el idpa basado en el numhs /////////
    $stmt = $connect->prepare("SELECT idpa FROM patients WHERE numhs = :num_control");
    $stmt->bindParam(':num_control', $numhs, PDO::PARAM_STR);
    $stmt->execute();
    $patient = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($patient) {
        // Si se encontró el colaborador, tomar el idpa
        $idpa = $patient['idpa'];

        // Insertar el evento usando el idpa 
        $sql = "INSERT INTO derivados(fecha, idpa, causa, obs) 
                VALUES(:fecha, :idpa, :causa, :obs)";
        
        $sql = $connect->prepare($sql);
        $sql->bindParam(':fecha', $fecha);
        $sql->bindParam(':idpa', $idpa);
        $sql->bindParam(':causa', $causa);
        $sql->bindParam(':obs', $obs);

       // $sql->execute();

        //$lastInsertId = $connect->lastInsertId();
        if ($sql->execute()) {
            header('Location: ../../frontend/derivados/mostrar.php');
            echo '<script type="text/javascript">
            
            swal("¡Registrado!", "Se resgistro la consulta correctamente", "success").then(function() {
                window.location = "../derivados/mostrar.php";
            });
            </script>';
        } else {
            echo '<script type="text/javascript">
            swal("Error!", "No se pueden agregar datos, comuníquese con el administrador", "error").then(function() {
                window.location = "nuevo.php";
            });
            </script>';
            print_r($sql->errorInfo());
        }
    } else {
        // Si el numhs no coincide con un colaborador, mostrar error
        echo '<script type="text/javascript">
        swal("Error!", "El número de control no existe. Verifique el número.", "error").then(function() {
            window.location = "nuevo.php";
        });
        </script>';
    }
}
?>