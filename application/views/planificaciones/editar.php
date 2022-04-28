<form class="form" method="post" id="frm">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3>Editar Planificación</h3>
            <div id="errors" class="alert alert-danger" role="alert" style="display:none;"></div>
            <div class="form-group">
                <label for="idPlanificacion">ID</label>
                <input type="text" class="form-control" value="<?php echo $idPlanificacion; ?>" id="idPlanificacion" name="idPlanificacion" placeholder="Código" readonly>
            </div>
            <div class="form-group">
                <label for="idAsignacion">Asignación:</label>
                <select class="form-control" name="idAsignacion" id="idAsignacion">
                    <?php foreach($asignados as $asig){ ?>
                        <option value="<?php echo $asig->idAsignacion;?>" <?php if($asig->idAsignacion == $idAsignacion){echo " selected";}?>><?php echo $asig->nombre." - [".$asig->materia."] - Grado: ".$asig->nivel."° - "; if($asig->tipo == "B"){ echo " [Básica]";}else if($asig->tipo == "M"){ echo " [Bachillerato]";}?></option>
                    <?php }?>
                </select>
            </div>
			<div class="form-group">
                <label for="anio">Año en que se realizó:</label>
                <input type="text" class="form-control" id="anio" name="anio" placeholder="año" value="<?php echo $anio;?>">
            </div>
        </div>
        <div class="col-md-4 offset-md-6">
            <div class="row justify-content-end">
                <div class="col-md-auto text-right">
                    <a href="<?php echo base_url()?>index.php/ProfesoresControlador/VerPlanificaciones/<?php echo $idProfesor;?>" class="btn btn-secondary">Volver</a>
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
                text: "¿Está seguro que desea editar la Planificación?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {
                    var idPlanificacion      = $('#idPlanificacion').val();
                    var idAsignacion         = $('#idAsignacion').val();
                    var anio                 = $('#anio').val();
                    
                    var data = {idPlanificacion: idPlanificacion, idAsignacion: idAsignacion, anio: anio};
                    $.post('<?php echo base_url()?>index.php/PlanificacionesControlador/Editar/<?php echo $idPlanificacion;?>/<?php echo $idAsignacion;?>/<?php echo $anio;?>/<?php echo $idProfesor;?>',data,function(response){
                        if(response == 'ok'){
                            window.location = '<?php echo base_url()?>index.php/ProfesoresControlador/VerPlanificaciones/<?php echo $idProfesor;?>';
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