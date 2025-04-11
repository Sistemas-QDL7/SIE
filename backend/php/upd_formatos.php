<?php
if(isset($_POST['upd_formatos']))
{
    $id = $_POST['id'];
    $codigo = $_POST['codigo'];
    $elaboracion = $_POST['elaboracion'];
    $revision = $_POST['revision'];
    $expiracion = $_POST['expiracion'];
    $rev = $_POST['rev'];
    $paginas = $_POST['paginas'];

    try {

        $query = "UPDATE format_templates 
                    SET codigo = :codigo,
                        elaboracion = :elaboracion,
                        revision = :revision,
                        expiracion = :expiracion,
                        rev = :rev,
                        paginas = :paginas
                    WHERE id = :id";
        $statement = $connect->prepare($query);

        $data = [
            ':codigo' => $codigo,
            ':elaboracion' => $elaboracion,
            ':revision' => $revision,
            ':expiracion' => $expiracion,
            ':rev' => $rev,
            ':paginas' => $paginas,
            ':id' => $id
        ];
        $query_execute = $statement->execute($data);

        if($query_execute)
        {
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script type="text/javascript">
            swal("¡Actualizado!", "Actualizado correctamente", "success").then(function() {
                        window.location = "../ajustes/formatos.php";
                    });
                    </script>';
            exit(0);
        }
        else
        {
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script type="text/javascript">
            swal("Error!", "Error al actualizar", "error").then(function() {
                        window.location = "../ajustes/formatos.php";
                    });
                    </script>';
            exit(0);
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>
