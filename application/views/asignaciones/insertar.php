<form class="form" method="post" id="frm">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3>Agregar Asignación</h3>
            <div id="errors" class="alert alert-danger" role="alert" style="display:none;"></div>
            <div class="form-group">
                <label for="usuario">Nombre Profesor</label>
                <select class="form-control" name="idUsuario" id="usuario">
                    <option>Seleccionar Profesor</option>
                    <?php foreach($profesores->result() as $res){ ?>
                    <option value="<?php echo $res->id;?>"><?php echo $res->nombre;?></option>
                    <?php }?>
                </select>
            </div>
			<div class="form-group">
                <label for="materia">Materia a Asignar</label>
                <select class="form-control" name="idMateria" id="materia">
                    <option>Seleccionar Materia</option>
                    <?php foreach($materias->result() as $res){ ?>
                    <option value="<?php echo $res->id;?>"><?php echo $res->nombre;?></option>
                    <?php }?>
                </select>
            </div>
			<div class="form-group">
                <label for="grado">Grado</label>
                <select class="form-control" name="idGrado" id="grado">
                    <option>Seleccionar Grado</option>
                    <?php foreach($grados->result() as $res){ ?>
                    <option value="<?php echo $res->id;?>"><?php echo $res->nombre;?></option>
                    <?php }?>
                </select>
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
                text: "¿Está seguro que desea guardar la Asignación?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {
                    var usuario               = $('#usuario').val();
					var materia               = $('#materia').val();
                    var grado               = $('#grado').val();
                    
                    var data = {idUsuario: usuario, idMateria: materia, idGrado: grado};
                    console.log(data);
                    $.post('<?php echo base_url()?>index.php/AsignacionesControlador/insertar',data,function(response){
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