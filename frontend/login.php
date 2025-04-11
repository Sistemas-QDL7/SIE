<?php 
include_once '../backend/php/login.php';
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SIE | QDL</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../backend/css/style.css" />
    <link rel="icon" type="image/png" sizes="96x96" href="../backend/img/ico.svg">
    <style>
      /* CSS personalizado para centrar el formulario y la imagen */
      body {
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f0f8ff;
        background-image: radial-gradient(circle, rgba(255,255,255,0.3) 1px, rgba(240,248,255,0) 1px);
        background-size: 50px 50px;
        /* Color de fondo */
      }

      .contenedor-principal {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column; /* Apila los elementos en una columna */
      }

      .form-container {
        background: #fff; /* Fondo blanco para el formulario */
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center; /* Centra el texto dentro del contenedor */
        width: 100%;
        max-width: 400px; /* Ancho máximo del formulario */
      }

      .form-input {
        width: 100%; /* Asegura que los campos ocupen todo el ancho del formulario */
        margin-bottom: 15px; /* Espacio entre los campos */
        padding: 10px; /* Espaciado interno */
        border-radius: 5px;
        border: 1px solid #ccc;
      }

      .btn {
        width: 215%; /* Ancho completo para el botón */
        padding: 10px;
        background-color: #333;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
      }

      .logo-img {
        width: 300px; /* Ajusta el tamaño según sea necesario */
        margin-top: 20px; /* Espacio entre el formulario y la imagen */
        height: auto;
      }
    </style>
  </head>
  <body>
    <div class="contenedor-principal">
      <div class="form-container">
        <h1 class="heading">
             SIE QDL
        </h1>
        <?php 
          if (isset($errMsg)) {
              echo '<div style="color:#FF0000;text-align:center;font-size:20px; font-weight:bold;">'.$errMsg.'</div>';
          }
        ?>
        <form action="" method="POST" autocomplete="off">
          <input
            type="text"
            name="username"
            value="<?php if(isset($_POST['username'])) echo $_POST['username'] ?>"
            class="form-input"
            placeholder="Nombre de usuario"
          />
          <input
            type="password"
            name="password"
            required
            class="form-input"
            placeholder="Contraseña"
          />
          <button class="btn" name="login" type="submit">Iniciar sesión</button>
        </form>
        <img src="/enfermeria/backend/img/sistemas.png" alt="Sistemas TI" class="logo-img">
      </div>
    </div>
  </body>
</html>
