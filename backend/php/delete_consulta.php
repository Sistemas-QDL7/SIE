<?php
    require_once('../../backend/bd/Conexion.php');
if(isset($_POST['delete_consulta'])){
////////////// Actualizar la tabla /////////
$consulta = "DELETE FROM `events` WHERE `id`=:id";
$sql = $connect-> prepare($consulta);
$sql -> bindParam(':id', $id, PDO::PARAM_INT);
$id=trim($_POST['id']);
$sql->execute();

if($sql->rowCount() > 0)
{
$count = $sql -> rowCount();
echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
        echo '<script type="text/javascript">
            swal("Eliminado!", "El registro ha sido eliminado correctamente.", "success").then(function() {
                window.location = "../citas/mostrar.php";
            });
        </script>';
}
else{
  echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
  echo '<script type="text/javascript">
      swal("Error!", "No se pudo eliminar el registro.", "error").then(function() {
          window.location = "../citas/mostrar.php";
      });
  </script>';

print_r($sql->errorInfo()); 
}
}// Cierra envio de guardado
?>


 

