<form class="form" method="post" id="frm">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3>Editar Rol</h3>
            <div id="errors" class="alert alert-danger" role="alert" style="display:none;"></div>
            <div class="form-group">
                <label for="idRol">ID</label>
                <input type="text" class="form-control" value="<?php echo $ListaRoles->idRol; ?>" id="idRol" name="idRol" placeholder="ID" readonly>
            </div>
            <div class="form-group">
                <label for="rol">Rol</label>
                <input type="text" class="form-control" id="rol" name="rol" placeholder="Rol" value="<?php echo $ListaRoles->rol;?>">
            </div>
        </div>
        <div class="col-md-8 offset-md-2 text-right">
            <button type="submit" class="btn btn-primary">Guardar</button>
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
                text: "¿Está seguro que desea editar la Asignación?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {
                    var idRol             = $('#idRol').val();
                    var rol               = $('#rol').val();
                    
                    var data = {idAsignacion: codigo, idUsuario: nombre, idMateria: materia, idGrado: nivel};
                    $.post('<?php echo base_url()?>index.php/AsignacionesControlador/editar/<?php echo $idAsignacion;?>',data,function(response){
                        if(response == 'ok'){
                            window.location = '<?php echo base_url()?>index.php/AsignacionesControlador';
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