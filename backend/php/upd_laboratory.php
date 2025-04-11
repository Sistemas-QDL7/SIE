<?php  
if(isset($_POST['upd_laboratory']))
{
    $idlab = $_POST['labid'];
    $nomlab = $_POST['labname'];

    
    try {

        $query = "UPDATE laboratory SET nomlab=:nomlab WHERE idlab=:idlab LIMIT 1";
        $statement = $connect->prepare($query);

        $data = [
            ':nomlab' => $nomlab,
            
            ':idlab' => $idlab
        ];
        $query_execute = $statement->execute($data);

        if($query_execute)
        {
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script type="text/javascript">
            swal("¡Actualizado!", "Actualizado correctamente", "success").then(function() {
                        window.location = "../recursos/laboratorio.php";
                    });
                    </script>';
            exit(0);
        }
        else
        {
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script type="text/javascript">
            swal("Error!", "Error al actualizar", "error").then(function() {
                        window.location = "../recursos/laboratorio.php";
                    });
                    </script>';
            exit(0);
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>



