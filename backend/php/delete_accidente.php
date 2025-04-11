<?php
    require_once('../../backend/bd/Conexion.php');
if(isset($_POST['delete_accidente'])){
////////////// Actualizar la tabla /////////
$consulta = "DELETE FROM `accidentes` WHERE `id_acc`=:id_acc";
$sql = $connect-> prepare($consulta);
$sql -> bindParam(':id_acc', $id_acc, PDO::PARAM_INT);
$id_acc=trim($_POST['id_acc']);
$sql->execute();

if($sql->rowCount() > 0)
{
$count = $sql -> rowCount();
echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
        echo '<script type="text/javascript">
            swal("Eliminado!", "El registro ha sido eliminado correctamente.", "success").then(function() {
                window.location = "../accidentes/mostrar.php";
            });
        </script>';
}
else{
  echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
  echo '<script type="text/javascript">
      swal("Error!", "No se pudo eliminar el registro.", "error").then(function() {
          window.location = "../accidentes/mostrar.php";
      });
  </script>';

print_r($sql->errorInfo()); 
}
}// Cierra envio de guardado
?>


 

