<?php
    require_once('../../backend/bd/Conexion.php');
if(isset($_POST['delete_incapacidad'])){
////////////// Actualizar la tabla /////////
$consulta = "DELETE FROM `incapacidades` WHERE `idinc`=:idinc";
$sql = $connect-> prepare($consulta);
$sql -> bindParam(':idinc', $idinc, PDO::PARAM_INT);
$idinc=trim($_POST['idinc']);
$sql->execute();

if($sql->rowCount() > 0)
{
$count = $sql -> rowCount();
echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
        echo '<script type="text/javascript">
            swal("Eliminado!", "El registro ha sido eliminado correctamente.", "success").then(function() {
                window.location = "../incapacidades/mostrar.php";
            });
        </script>';
}
else{
  echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
  echo '<script type="text/javascript">
      swal("Error!", "No se pudo eliminar el registro.", "error").then(function() {
          window.location = "../incapacidades/mostrar.php";
      });
  </script>';

print_r($sql->errorInfo()); 
}
}// Cierra envio de guardado
?>


 

