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
                <option value="1" <?php if($asignaciones->idGrado == 1){echo " selected";}?>>1</option>
                <option value="2" <?php if($asignaciones->idGrado == 2){echo " selected";}?>>2</option>
                <option value="3" <?php if($asignaciones->idGrado == 3){echo " selected";}?>>3</option>
                <option value="4" <?php if($asignaciones->idGrado == 4){echo " selected";}?>>4</option>
                <option value="5" <?php if($asignaciones->idGrado == 5){echo " selected";}?>>5</option>
                <option value="6" <?php if($asignaciones->idGrado == 6){echo " selected";}?>>6</option>
                <option value="7" <?php if($asignaciones->idGrado == 7){echo " selected";}?>>7</option>
                <option value="8" <?php if($asignaciones->idGrado == 8){echo " selected";}?>>8</option>
                <option value="9" <?php if($asignaciones->idGrado == 9){echo " selected";}?>>9</option>
                <option value="10" <?php if($asignaciones->idGrado == 10){echo " selected";}?>>10</option>
                <option value="11" <?php if($asignaciones->idGrado == 11){echo " selected";}?>>11</option>
                <option value="12" <?php if($asignaciones->idGrado == 12){echo " selected";}?>>12</option>
                </select>
            </div>
            <div class="col-md-8 offset-md-2 text-right">
                <button type="submit" class="btn btn-primary">Guardar</button>
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
                text: "¿Está seguro que desea editar la Asignación?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {
                    var codigo               = $('#codigo').val();
                    var materia              = $('#mat').val();
                    var nivel                = $('#grad').val();
                    
                    var data = {idAsignacion: codigo, idMateria: materia, idGrado: nivel};
                    $.post('<?php echo base_url()?>index.php/MNDirControlador/editar/<?php echo $idUnidad;?>',data,function(response){
                        if(response == 'ok'){
                            window.location = '<?php echo base_url()?>index.php/MNDirControlador';
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