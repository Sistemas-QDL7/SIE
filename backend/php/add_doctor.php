<?php 
require_once('../../backend/bd/Conexion.php'); 
 if(isset($_POST['add_doctor']))
 {
  //$username = $_POST['user_name'];// user name
  //$userjob = $_POST['user_job'];// user email
    $ceddoc=trim($_POST['cem']);
    $nodoc=trim($_POST['named']);
    $apdoc=trim($_POST['apeme']);
    $nomesp=trim($_POST['espm']);
    //$direcd=trim($_POST['dime']);
    $sexd=trim($_POST['geme']);
    //$phd=trim($_POST['telme']);
    //$nacd=trim($_POST['cumme']);
    
   
    
  if(empty($ceddoc)){
   $errMSG = "Please enter cedula.";
  }
  else if(empty($nodoc)){
   $errMSG = "Please Enter your name.";
  }
   
  $stmt = "SELECT * FROM doctor WHERE ceddoc ='$ceddoc'";
   if(empty($ceddoc)) {
             echo '<div id="cookiePopup" class="hide">
      <img src="../../backend/img/error.png" />
      <p>
        Ya existe el registro a agregar!
      </p>
      <button id="acceptCookie" type="button">OK</button>
    </div>';
         }

         else
         {  // Validaremos primero que el document no exista
            $sql="SELECT * FROM doctor WHERE ceddoc ='$ceddoc'";
            

            $stmt = $connect->prepare($sql);
            $stmt->execute();

            if ($stmt->fetchColumn() == 0) // Si $row_cnt es mayor de 0 es porque existe el registro
            {
                if(!isset($errMSG))
  {
   $stmt = $connect->prepare("INSERT INTO doctor(ceddoc,nodoc,apdoc,nomesp,sexd,state) VALUES(:ceddoc,:nodoc,:apdoc,:nomesp,:sexd, '1')");


$stmt->bindParam(':ceddoc',$ceddoc);
$stmt->bindParam(':nodoc',$nodoc);
$stmt->bindParam(':apdoc',$apdoc);
$stmt->bindParam(':nomesp',$nomesp);
//$stmt->bindParam(':direcd',$direcd);
$stmt->bindParam(':sexd',$sexd);
//$stmt->bindParam(':phd',$phd);
//$stmt->bindParam(':nacd',$nacd);


   if($stmt->execute())
   {
    echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script type="text/javascript">
            swal("¡Registrado!", "Se registro el colaboradorcorrectamente", "success").then(function() {
                        window.location = "../medicos/mostrar.php";
                    });
                    </script>';
   }
   else
   {
    $errMSG = "error while inserting....";
   }

  } 
            }

                else{

                  echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                  echo '<script type="text/javascript">
                  swal("Error!", "Error al registrar", "error").then(function() {
                              window.location = "../medicos/mostrar.php";
                          });
                          </script>';

 // if no error occured, continue ....

}
  

  }
 
 }
?>