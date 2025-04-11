<!--Ventana Modal-->
<form method="POST" >
    <input type="checkbox" id="btns-modal">
    <div class="container-modal">
        <div class="content-modal">
            <h2>Nueva nota</h2>
            <hr>
            <label for="email"><b>Notas</b></label><span class="badge-warning">*</span>

            <textarea  name="consl" id="consl" required placeholder="Agregar nota..." style="height:200px"></textarea>

          
            <input type="hidden" id="csidpa" name="csidpa" value="<?php echo $d->idpa; ?>">
            <input type="hidden" id="csnopa" name="csnopa" value="<?php echo $d->$_SESSION['idodc']; ?>">
           
            

            <input type="button" class="registerbtn" name="submit" value="Guardar" onclick="enviar();"> 
        </div>
        <label for="btns-modal" class="cerrar-modal"></label>
    </div>
    </form>
<!--Fin de Ventana Modal-->