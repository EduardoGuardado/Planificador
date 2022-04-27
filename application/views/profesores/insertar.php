<form class="form" method="post" id="frm">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3>Agregar Nuevo Profesor</h3>
            <div id="errors" class="alert alert-danger" role="alert" style="display:none;"></div>
            <br>
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Miguel">
            </div>
            <div class="form-group">
                <label for="nombre">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Velasquez">
            </div>
            <div class="form-group">
                <label for="nombre">Correo</label>
                <input type="text" class="form-control" id="correo" name="correo" placeholder="mvelasquez@mail.com">
            </div>
            <div class="form-group">
                <label for="nombre">Telefono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="75453431">
            </div>
			<div class="form-group">
                <label for="usuario">Usuario</label>
                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Mv">
            </div>
			<div class="form-group">
                <label for="clave">Clave</label>
                <input type="password" class="form-control" id="clave" name="clave" placeholder="**********">
            </div>
			<div class="form-group">
                <label for="idRol">Rol que se asignará:</label>
                <select class="form-control" name="idRol" id="idRol">
                    <option>Seleccionar el rol...</option>
                    <?php foreach($verRol as $r){ ?>
                    <option value="<?php echo $r->idRol;?>"><?php echo $r->rol;?></option>
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
                text: "¿Está seguro que desea guardar el Profesor?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {
                    var nombre      = $('#nombre').val();
                    var apellido    = $('#apellido').val();
                    var correo      = $('#correo').val();
                    var telefono    = $('#telefono').val();
					var usuario     = $('#usuario').val();
                    var clave       = $('#clave').val();
					var idRol       = $('#idRol').val();
                    
                    var data = {nombre: nombre, apellido: apellido, correo: correo, telefono: telefono, usuario: usuario, clave: clave, idRol: idRol};

                    $.post('<?php echo base_url()?>index.php/ProfesoresControlador/Insertar',data,function(response){
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