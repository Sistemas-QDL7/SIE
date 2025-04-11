<?php  
if(isset($_POST['upd_patiens']))
{
    $idpa = $_POST['pid'];
    $numhs = $_POST['nhi'];
    $nompa = $_POST['namp'];
    $apepa = $_POST['apep'];
   // $direc = $_POST['dip'];
    $sex = $_POST['gep'];
    $grup = $_POST['grp'];
   // $id_area = $_POST['id_area'];
   // $fere = $_POST['fere'];
    $state = $_POST['state'];
    
    try {

        $query = "UPDATE patients SET numhs=:numhs, nompa=:nompa, apepa=:apepa,sex=:sex,grup=:grup, state=:state WHERE idpa=:idpa LIMIT 1";
        $statement = $connect->prepare($query);

        $data = [
            ':numhs' => $numhs,
            ':nompa' => $nompa,
            ':apepa' => $apepa,
           // ':direc' => $direc,
            ':sex' => $sex,
            ':grup' => $grup,
          //  ':id_area' => $id_area,
            //':fere' => $fere,
            ':idpa' => $idpa,
            ':state' => $state

        ];
        $query_execute = $statement->execute($data);

        if($query_execute)
        {
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script type="text/javascript">
            swal("¡Actualizado!", "Actualizado correctamente", "success").then(function() {
                        window.location = "../pacientes/mostrar.php";
                    });
                    </script>';
            exit(0);
        }
        else
        {
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script type="text/javascript">
            swal("Error!", "Error al actualizar", "error").then(function() {
                    window.location = "../pacientes/mostrar.php";
                    });
                    </script>';
            exit(0);
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>