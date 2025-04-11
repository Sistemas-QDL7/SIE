<?php
    require_once('../../backend/bd/Conexion.php');
if(isset($_POST['delete_derivados'])){
////////////// Actualizar la tabla /////////
$consulta = "DELETE FROM `derivados` WHERE `id_der`=:id_der";
$sql = $connect-> prepare($consulta);
$sql -> bindParam(':id_der', $id_der, PDO::PARAM_INT);
$id_der=trim($_POST['id_der']);
$sql->execute();

if($sql->rowCount() > 0)
{
$count = $sql -> rowCount();
echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
        echo '<script type="text/javascript">
            swal("Eliminado!", "El registro ha sido eliminado correctamente.", "success").then(function() {
                window.location = "../derivados/mostrar.php";
            });
        </script>';
}
else{
  echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
  echo '<script type="text/javascript">
      swal("Error!", "No se pudo eliminar el registro.", "error").then(function() {
          window.location = "../derivados/mostrar.php";
      });
  </script>';

print_r($sql->errorInfo()); 
}
}// Cierra envio de guardado
?>


 

