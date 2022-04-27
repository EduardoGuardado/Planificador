<form class="form" method="post" id="frm">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3>Editar datos del Profesor<?php echo ": ".$profesor[0]->nombre." ".$profesor[0]->apellido;?></h3>
            <div id="errors" class="alert alert-danger" role="alert" style="display:none;"></div>
            <div class="form-group">
                <label for="idUsuario">ID</label>
                <input type="text" class="form-control" value="<?php echo $profesor[0]->idUsuario; ?>" id="idUsuario" name="idUsuario" placeholder="idUsuario" readonly>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre: </label>
                <input type="text" class="form-control" value="<?php echo $profesor[0]->nombre; ?>" id="nombre" name="nombre" placeholder="Nombre">
            </div>
			<div class="form-group">
                <label for="apellido">Apellido: </label>
                <input type="text" class="form-control" value="<?php echo $profesor[0]->apellido; ?>" id="apellido" name="apellido" placeholder="Apellido">
            </div>
			<div class="form-group">
                <label for="correo">Correo</label>
                <input type="text" class="form-control" value="<?php echo $profesor[0]->correo; ?>" id="correo" name="correo" placeholder="Correo">
            </div>
			<div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" class="form-control" value="<?php echo $profesor[0]->telefono; ?>" id="telefono" name="telefono" placeholder="Teléfono">
            </div>
            <div class="form-group">
                <label for="usuario">Usuario</label>
                <input type="text" class="form-control" value="<?php echo $profesor[0]->usuario; ?>" id="usuario" name="usuario" placeholder="Usuario">
            </div>
            <div class="form-group">
                <label for="clave">Clave</label>
                <input type="password" class="form-control" value="<?php echo $profesor[0]->clave; ?>" id="clave" name="clave" placeholder="Contraseña">
            </div>
            <div class="form-group">
                <label for="idRol">Rol</label>
                <select class="form-control" name="idRol" id="idRol">
                    <?php foreach($verRol as $r){ ?>
                    <option value="<?php echo $r->idRol;?>" <?php if($r->rol == $profesor[0]->rol){echo " selected";}?>><?php echo $r->rol;?></option>
                    <?php }?>
                </select>
            </div>
        </div>
        <div class="col-md-4 offset-md-6">
            <div class="row justify-content-end">
                <div class="col-md-auto text-right">
                    <a href="<?php echo base_url()?>index.php/PerfilesControlador/VerProfesores" class="btn btn-secondary">Volver</a>
                </div>
                <div class="col-sm-4 text-right">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
	$(function(){
		$('#frm').submit(function(e){
			e.preventDefault();
            $('#errors').hide();
            
            swal({
                title: "Guardar",
                text: "¿Está seguro que desea editar el Profesor?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {
                    var idUsuario           = $('#idUsuario').val();
                    var nombre              = $('#nombre').val();
                    var apellido            = $('#apellido').val();
                    var correo              = $('#correo').val();
                    var telefono            = $('#telefono').val();
                    var usuario             = $('#usuario').val();
                    var clave               = $('#clave').val();
                    var idRol               = $('#idRol').val();
                    
                    var data = {idUsuario: idUsuario, nombre: nombre, apellido: apellido, correo: correo, telefono: telefono, usuario: usuario, clave: clave, idRol: idRol};

                    $.post('<?php echo base_url()?>index.php/ProfesoresControlador/Editar/<?php echo $id;?>',data,function(response){
                        if(response == 'ok'){
                            window.location = '<?php echo base_url()?>index.php/PerfilesControlador/VerProfesores';
                        }else{
                            $('#errors').html(response);
                            $('#errors').show();
                        }
                    });
                }
            });

            
		});
	});
</script>