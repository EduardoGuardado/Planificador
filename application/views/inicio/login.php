<div class="row justify-content-md-center" style="padding-top: 0.2em;">
    <div class="col-md-auto">
    <img src="./assets/img/logoedusys.png" class="img-fluid" alt="...">
    </div>
    <div class="col-md-auto">
        <form class="form" action="<?php echo base_url()?>index.php/InicioControlador/InicioSesion" method="post">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <h3>Iniciar sesión</h3>
                    <div id="errors" class="alert alert-danger" role="alert" style="display:none;"></div>
                    <div class="form-group">
                        <label for="usuario">Usuario asignado:</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ah" required="">
                    </div>
                    <div class="form-group">
                        <label for="clave">Contraseña:</label>
                        <input type="password" class="form-control" id="clave" name="clave" placeholder="contraseña" required="">
                    </div>
                </div>
                <div class="col-md-8 offset-md-2 text-right">
                    <button type="submit" class="btn btn-primary">Acceder</button>
                </div>
            </div>
        </form>
    </div>
</div>
