<?php  
if(isset($_POST['upd_medicine']))
{
    $idprcd = $_POST['meid'];
    $codpro = $_POST['medicode'];
    $nompro = $_POST['mediname'];
    $idcat = $_POST['medicate'];
    $preprd = $_POST['mediprec'];
    $state =  $_POST['state'];


    
    try {

        $query = "UPDATE product SET codpro=:codpro,nompro=:nompro,idcat=:idcat,preprd=:preprd, state=:state WHERE idprcd=:idprcd LIMIT 1";
        $statement = $connect->prepare($query);

        $data = [
            ':codpro' => $codpro,
            ':nompro' => $nompro,
            ':idcat' => $idcat,
            ':preprd' => $preprd,
            ':state' =>  $state,
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



