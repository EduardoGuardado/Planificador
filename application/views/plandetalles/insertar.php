<form class="form" method="post" id="frm">
    <div class="row">
        <!-- REEMPLAZAMOS LOS CARACTERES ESPECIALES QUE SE AGREGARON EN LA URl Y DE ESTA MANERA PASAR EL VAROL EXACTO-->
        <?php $Nmateria = preg_replace('/[0-9\@\.\;\" "\%]+/', ' ', $materia);?>
        <div class="col-md-8 offset-md-2">
            <h3>Contenido a la Planificación</h3>
            <div id="errors" class="alert alert-danger" role="alert" style="display:none;"></div>
            <div class="form-group">
                <input type="hidden" id="idPlanificacion" value="<?php echo $idPlanificacion;?>">
            </div>
            <div class="form-group">
                <label for="idContenido">Contenido a utilizar:</label>
                <select class="form-control" name="idContenido" id="idContenido">
                    <option>Seleccionar Contenido</option>
                    <?php foreach($contenido as $res){ ?>
                        <?php if($res->materia == $Nmateria){?>
                            <option value="<?php echo $res->idContenido;?>"><?php echo "Unidad ".$res->unidad.": ".$res->nombreUnidad." - ".$res->correlativo." ".$res->tema;?></option>
                        <?php }?>
                    <?php }?>
                </select>
            </div>
			<div class="form-group">
                <label for="desde">Fecha de inicio:</label>
                <input type="date" class="form-control" name="desde" id="desde" step="1" min="2010-01-01" max="2030-12-31">
            </div>
            <div class="form-group">
                <label for="hasta">Fecha de finalización:</label>
                <input type="date" class="form-control" name="hasta" id="hasta" step="1" min="2010-01-01" max="2030-12-31">
            </div>
            <div class="form-group">
                <label for="ejecutado">Fecha de ejecución:</label>
                <input type="date" class="form-control" name="ejecutado" id="ejecutado" step="1" min="2010-01-01" max="2030-12-31">
            </div>
        </div>
        <div class="col-md-4 offset-md-6">
            <div class="row justify-content-end">
                <div class="col-md-auto text-right">
                    <a href="<?php echo base_url()?>index.php/PlanificacionesControlador/VerDetalles/<?php echo $idPlanificacion;?>/<?php echo $idAsignacion;?>/<?php echo $anio;?>/<?php echo $materia;?>" class="btn btn-secondary">Volver</a>
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
                text: "¿Está seguro que desea guardar el detalle de la planificación?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {
                    var idPlanificacion     = $('#idPlanificacion').val();
					var desde               = $('#desde').val();
                    var hasta               = $('#hasta').val();
					var idContenido         = $('#idContenido').val();
                    var ejecutado           = $('#ejecutado').val();
                    
                    var data = {idPlanificacion: idPlanificacion, desde: desde, hasta: hasta, idContenido: idContenido, ejecutado: ejecutado};
                    console.log(data);
                    $.post('<?php echo base_url()?>index.php/PlanDetallesControlador/Insertar',data,function(response){
                        if(response == 'ok'){
                            window.location = '<?php echo base_url()?>index.php/PlanificacionesControlador/VerDetalles/<?php echo $idPlanificacion;?>/<?php echo $idAsignacion;?>/<?php echo $anio;?>/<?php echo $materia;?>';
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