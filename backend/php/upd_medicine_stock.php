<?php  
if(isset($_POST['upd_medicine_stock']))
{
    $idprcd = $_POST['meid'];
    $stock = $_POST['medistoc'];


    
    try {

        $query = "UPDATE product SET stock=:stock WHERE idprcd=:idprcd LIMIT 1";
        $statement = $connect->prepare($query);

        $data = [
            ':stock' => $stock,
            
            ':idprcd' => $idprcd
        ];
        $query_execute = $statement->execute($data);

        if($query_execute)
        {
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script type="text/javascript">
            swal("¡Actualizado!", "Actualizado correctamente", "success").then(function() {
                        window.location = "../medicinas/mostrar.php";
                    });
                    </script>';
            exit(0);
        }
        else
        {
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script type="text/javascript">
            swal("Error!", "Error al actualizar", "error").then(function() {
                        window.location = "../medicinas/mostrar.php";
                    });
                    </script>';
            exit(0);
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>



