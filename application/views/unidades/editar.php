<form class="form" method="post" id="frm">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3>Editar Datos Generales de la Unidad</h3>
            <div id="errors" class="alert alert-danger" role="alert" style="display:none;"></div>
            <input type="hidden" value="<?php echo $unidades->idAsignacion; ?>" id="idAsignacion" name="idAsignacion">
            <div class="form-group">
                <label for="unidad">Unidad #</label>
                <input type="text" class="form-control" value="<?php echo $unidades->unidad; ?>" id="unidad" name="unidad" placeholder="Número Unidad">
            </div>
 			<div class="form-group">
                <label for="nomUni">Nombre de la Unidad:</label>
                <input type="text" class="form-control" value="<?php echo $unidades->nombreUnidad; ?>" id="nombreUnidad" name="nombreUnidad" placeholder="Nombre Unidad">
            </div>
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
                text: "¿Está seguro que desea editar la Unidad?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {
                    var unidad               = $('#unidad').val();
                    var nomUni              =$('#nomUni').val();
                    var idAsig          =$('#idAsignacion').val();

                    var data = {idAsignacion: idAsig, unidad: unidad, nombreUnidad:nomUni};
                    $.post('<?php echo base_url()?>index.php/UnidadesControlador/editar/<?php echo $idDetalleUnidad;?>/'+idAsig,data,function(response){
                        if(response == 'ok'){
                            window.location = '<?php echo base_url()?>index.php/UnidadesControlador/index/'+idAsig;
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