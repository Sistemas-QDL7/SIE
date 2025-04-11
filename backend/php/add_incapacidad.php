<?php 
require_once('../../backend/bd/Conexion.php'); 

if (isset($_POST['add_incapacidad'])) {
    $folio = trim($_POST['folio']);//Tipo de folio
    $numhs = trim($_POST['num_control']); // El valor de NUMERO DE CONTROL
    $inicio = trim($_POST['inicio']);
    $fin = trim($_POST['fin']);
    $dias = trim($_POST['dias']);
    $motivo = trim($_POST['motivo']);
    $ini_sub = trim($_POST['ini_sub']);
    $dias_acum = trim($_POST['dias_acum']);
    $tipo = trim($_POST['tipo']);


    ///////// Buscar el idpa basado en el numhs /////////
    $stmt = $connect->prepare("SELECT idpa FROM patients WHERE numhs = :num_control");
    $stmt->bindParam(':num_control', $numhs, PDO::PARAM_STR);
    $stmt->execute();
    $patient = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($patient) {
        // Si se encontró el colaborador, tomar el idpa
        $idpa = $patient['idpa'];

        // Insertar el evento usando el idpa 
        $sql = "INSERT INTO incapacidades(folio, idpa, inicio, fin, dias, motivo, ini_sub, dias_acum, tipo) 
                VALUES(:folio, :idpa, :inicio, :fin, :dias, :motivo, :ini_sub, :dias_acum, :tipo)";
        
        $sql = $connect->prepare($sql);
        $sql->bindParam(':folio', $folio);
        $sql->bindParam(':idpa', $idpa);
        $sql->bindParam(':inicio', $inicio);
        $sql->bindParam(':fin', $fin);
        $sql->bindParam(':dias', $dias);
        $sql->bindParam(':motivo', $motivo);
        $sql->bindParam(':ini_sub', $ini_sub);
        $sql->bindParam(':dias_acum', $dias_acum);
        $sql->bindParam(':tipo', $tipo);

       // $sql->execute();

        //$lastInsertId = $connect->lastInsertId();
        if ($sql->execute()) {
            header('Location: ../../frontend/incapacidades/mostrar.php');
            echo '<script type="text/javascript">
            
            swal("¡Registrado!", "Se resgistro la consulta correctamente", "success").then(function() {
                window.location = "../incapacidades/mostrar.php";
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