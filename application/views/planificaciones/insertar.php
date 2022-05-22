<form class="form" method="post" id="frm">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3>Agregar Nueva Planificación</h3>
            <br>
            <div id="errors" class="alert alert-danger" role="alert" style="display:none;"></div>
            <div class="form-group">
                <label for="usuario">Seleccionar Asignación:</label>
                <select class="form-control" name="idAsignacion" id="asignacion">
                    <option>Asignación...</option>
                    <?php foreach($asignados as $asig){ ?>
                        <option value="<?php echo $asig->idAsignacion;?>"><?php echo $asig->nombre." - [".$asig->materia."] - Grado: ".$asig->nivel."° - "; if($asig->tipo == "B"){ echo " [Básica]";}else if($asig->tipo == "M"){ echo " [Bachillerato]";}?></option>
                    <?php }?>
                </select>
            </div>
			<div class="form-group">
                <label for="materia">Año en que se realizará:</label>
                <input type="text" class="form-control" id="anio" name="anio" placeholder="año">
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
                text: "¿Está seguro que desea guardar la Asignación?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {
                    var asignacion         = $('#asignacion').val();
					var anio               = $('#anio').val();
                    
                    var data = {idAsignacion: asignacion, anio: anio};
                    
                    $.post('<?php echo base_url()?>index.php/PlanificacionesControlador/Insertar',data,function(response){
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