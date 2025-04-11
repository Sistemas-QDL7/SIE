<?php 
require_once('../../backend/bd/Conexion.php'); 
 if(isset($_POST['add_user']))
 {
  //$username = $_POST['user_name'];// user name
  //$userjob = $_POST['user_job'];// user email
    
    $username =trim($_POST['username']);
    $name = trim($_POST['name']);
    $email =trim($_POST['email']);
    $password =trim($_POST['password']);
    $rol = trim($_POST['rol']);
    $idodc = trim($_POST['idodc']);
   
    
  if(empty($username)){
   $errMSG = "Porfavor ingresa un nombre de usuario.";
  }
  else if(empty($password)){
   $errMSG = "Porfavor ingresa una contraseña.";

  }
   
  $stmt = "SELECT * FROM users WHERE username ='$username'";
   if(empty($username)) {
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
            $sql="SELECT * FROM users WHERE username ='$username'";
            

            $stmt = $connect->prepare($sql);
            $stmt->execute();

            if ($stmt->fetchColumn() == 0) // Si $row_cnt es mayor de 0 es porque existe el registro
            {
                if(!isset($errMSG))
  {
   $stmt = $connect->prepare("INSERT INTO users(username,name,email,password,rol,idodc) VALUES(:username,:name,:email,:password,:rol,'1')");


$stmt->bindParam(':username',$username);
$stmt->bindParam(':name',$name);
$stmt->bindParam(':email',$email);
$stmt->bindParam(':password',$password);
$stmt->bindParam(':rol',$rol);
$stmt->bindParam(':idodc',$idodc);



   if($stmt->execute())
   {
    // Si la inserción fue exitosa
    echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
    echo '<script type="text/javascript">
        swal("Agregado!", "El usuario ha sido agregado correctamente.", "success").then(function() {
            window.location = "../users/mostrar.php";
        });
    </script>';
   }
   else
   {
    // Si ocurrió algún error al insertar
    echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
    echo '<script type="text/javascript">
        swal("Error", "Ocurrió un error al agregar el usuario.", "error");
    </script>';
   }

  } 
            }
  }
}
?>