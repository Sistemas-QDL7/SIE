<?php 
require_once('../../backend/bd/Conexion.php'); 

if(isset($_POST['add_docu'])){
    // Información enviada por el formulario
    $nomfi = $_POST['docdoc'];
    $idpa = $_POST['docidpa'];
    $nompa = $_POST['docnopa'];

    $file = $_FILES['foto']['name'];
    $tmp_dir = $_FILES['foto']['tmp_name'];
    $fileSize = $_FILES['foto']['size'];

    if(empty($nomfi)){
        $errMSG = "Please enter your name.";
    } else if(empty($nompa)){
        $errMSG = "Please enter your number.";
    }

    if (!isset($errMSG)) {
        $upload_dir = '../../backend/files/subidas/'; // Directorio de subida
        $fileExt = strtolower(pathinfo($file, PATHINFO_EXTENSION)); // Obtener extensión del archivo

        // Extensiones válidas
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'pdf'); // Agregar 'pdf'

        // Renombrar archivo subido
        $newFileName = rand(1000, 1000000) . "." . $fileExt;

        // Verificar si la extensión es válida
        if (in_array($fileExt, $valid_extensions)) {   
            // Verificar tamaño del archivo (5MB máximo)
            if ($fileSize < 5000000) {
                if (move_uploaded_file($tmp_dir, $upload_dir . $newFileName)) {
                    // Insertar en la base de datos
                    $sql = "INSERT INTO document (nomfi, foto, idpa, nompa, state) 
                            VALUES (:nomfi, :foto, :idpa, :nompa, '1')";
                    $stmt = $connect->prepare($sql);

                    $stmt->bindParam(':nomfi', $nomfi, PDO::PARAM_STR, 25);
                    $stmt->bindParam(':foto', $newFileName, PDO::PARAM_STR, 25);
                    $stmt->bindParam(':idpa', $idpa, PDO::PARAM_STR, 25);
                    $stmt->bindParam(':nompa', $nompa, PDO::PARAM_STR, 25);

                    if ($stmt->execute()) {
                        echo '<script type="text/javascript">
                            swal("¡Registrado!", "Agregado correctamente", "success").then(function() {
                                window.location = "documentos.php";
                            });
                        </script>';
                    } else {
                        echo '<script type="text/javascript">
                            swal("Error!", "No se pueden agregar datos, comuníquese con el administrador.", "error").then(function() {
                                window.location = "documentos.php";
                            });
                        </script>';
                        print_r($stmt->errorInfo());
                    }
                } else {
                    $errMSG = "Error al subir el archivo.";
                }
            } else {
                $errMSG = "Lo siento, el archivo es demasiado grande (máximo 5MB).";
            }
        } else {
            $errMSG = "Solo se permiten archivos JPG, JPEG, PNG, GIF y PDF.";
        }
    }

    if (isset($errMSG)) {
        echo '<script type="text/javascript">
            swal("Error!", "'.$errMSG.'", "error").then(function() {
                window.location = "documentos.php";
            });
        </script>';
    }
}
?>
