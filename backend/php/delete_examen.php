<?php
    require_once('../../backend/bd/Conexion.php');
if(isset($_POST['delete_examen'])){
////////////// Actualizar la tabla /////////
$consulta = "DELETE FROM `examenes` WHERE `idex`=:idex";
$sql = $connect-> prepare($consulta);
$sql -> bindParam(':idex', $idex, PDO::PARAM_INT);
$idex=trim($_POST['idex']);
$sql->execute();

if($sql->rowCount() > 0)
{
$count = $sql -> rowCount();
echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
        echo '<script type="text/javascript">
            swal("Eliminado!", "El registro ha sido eliminado correctamente.", "success").then(function() {
                window.location = "../examenes/mostrar.php";
            });
        </script>';
}
else{
  echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
  echo '<script type="text/javascript">
      swal("Error!", "No se pudo eliminar el registro.", "error").then(function() {
          window.location = "../examenes/mostrar.php";
      });
  </script>';

print_r($sql->errorInfo()); 
}
}// Cierra envio de guardado
?>


 

