<form action="<?php echo base_url()?>index.php/ProfesoresControlador/Insertar" method="post">
    <label for="">Nombre:</label>
    <input type="text" name="nombre">
    <br>
    <label for="">Apellido:</label>
    <input type="text" name="apellido">
    <br>
    <label for="">Correo:</label>
    <input type="text" name="correo">
    <br>
    <label for="">Telefono:</label>
    <input type="text" name="telefono">
    <br>
    <label for="">Usuario:</label>
    <input type="text" name="usuario">
    <br>
    <label for="">Contraseña:</label>
    <input type="password" name="clave">
    <br>
    <input type="hidden" name="idRol" value="1">
    <br>
    <input type="submit" value="enviar">
</form>