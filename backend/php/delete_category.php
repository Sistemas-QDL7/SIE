<?php
    require_once('../../backend/bd/Conexion.php');
if(isset($_POST['delete_category'])){
////////////// Actualizar la tabla /////////
$consulta = "DELETE FROM `category` WHERE `idcat`=:idcat";
$sql = $connect-> prepare($consulta);
$sql -> bindParam(':idcat', $idcat, PDO::PARAM_INT);
$idcat=trim($_POST['idcat']);
$sql->execute();

if($sql->rowCount() > 0)
{
$count = $sql -> rowCount();
echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
        echo '<script type="text/javascript">
            swal("Eliminado!", "El registro ha sido eliminado correctamente.", "success").then(function() {
                window.location = "../medicinas/categoria.php";
            });
        </script>';
}
else{
    echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
    echo '<script type="text/javascript">
        swal("Error!", "No se pudo eliminar el registro.", "error").then(function() {
            window.location = "../medicinas/categoria.php";
        });
    </script>';

print_r($sql->errorInfo()); 
}
}// Cierra envio de guardado
?>


 

