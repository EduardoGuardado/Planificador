<form class="form" method="post" id="frm">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3>Editar Asignación</h3>
            <div id="errors" class="alert alert-danger" role="alert" style="display:none;"></div>
            <div class="form-group">
                <label for="codigo">ID</label>
                <input type="text" class="form-control" value="<?php echo $asignaciones->idAsignacion; ?>" id="codigo" name="idAsignacion" placeholder="Código" readonly>
            </div>
            <div class="form-group">
                <label for="nombre">Profesor:</label>
                <select class="form-control" name="idUsuario" id="usuario">
                    <?php foreach($profesores->result() as $res){ ?>
                    <option value="<?php echo $res->id;?>" <?php if($res->id == $asignaciones->idUsuario){echo " selected";}?>><?php echo $res->nombre;?></option>
                    <?php }?>
                </select>
            </div>
			<div class="form-group">
                <label for="materia">Materia:</label>
                <select class="form-control" name="idMateria" id="mat">
                    <?php foreach($materias->result() as $res){ ?>
                    <option value="<?php echo $res->id;?>" <?php if($res->id == $asignaciones->idMateria){echo " selected";}?>><?php echo $res->nombre;?></option>
                    <?php }?>
                </select>
            </div>
			<div class="form-group">
                <label for="grado">Grado °:</label>
                <select class="form-control" name="idGrado" id="grad">
                    <?php foreach($grados->result() as $res){ ?>
                    <option value="<?php echo $res->id;?>" <?php if($res->id == $asignaciones->idGrado){echo " selected";}?>><?php echo $res->nombre;?></option>
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
                text: "¿Está seguro que desea editar la Asignación?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {
                    var codigo               = $('#codigo').val();
                    var nombre               = $('#usuario').val();
                    var materia              = $('#mat').val();
                    var nivel                = $('#grad').val();
                    
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