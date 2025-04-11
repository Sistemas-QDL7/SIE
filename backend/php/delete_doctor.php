<?php
    require_once('../../backend/bd/Conexion.php');
if(isset($_POST['delete_patients'])){
////////////// Actualizar la tabla /////////
$consulta = "DELETE FROM `doctor` WHERE `idodc`=:idodc";
$sql = $connect-> prepare($consulta);
$sql -> bindParam(':idodc', $idodc, PDO::PARAM_INT);
$idodc=trim($_POST['idodc']);
$sql->execute();

if($sql->rowCount() > 0)
{
$count = $sql -> rowCount();
echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
        echo '<script type="text/javascript">
            swal("Eliminado!", "El registro ha sido eliminado correctamente.", "success").then(function() {
                window.location = "../medicos/mostrar.php";
            });
        </script>';
}
else{
  echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
  echo '<script type="text/javascript">
      swal("Eliminado!", "El registro ha sido eliminado correctamente.", "success").then(function() {
          window.location = "../medicos/mostrar.php";
      });
  </script>';

print_r($sql->errorInfo()); 
}
}// Cierra envio de guardado
?>


 

