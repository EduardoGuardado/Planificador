<form class="form" method="post" id="frm">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3>Editar Datos Generales del contenido</h3>
            <input type="hidden" value="<?php echo $idDetalleUnidad ?>" id="idDetalleUnidad" name="idDetalleUnidad">
            <div class="form-group">
                <label for="correlativo">Correlativo:</label>
                <input type="text" class="form-control" value="<?php echo $contenido->correlativo; ?>" id="correlativo" name="correlativo" placeholder="Número del tema">
            </div>
 			<div class="form-group">
                <label for="tema">Nombre del tema:</label>
                <input type="text" class="form-control" value="<?php echo $contenido->tema; ?>" id="tema" name="tema" placeholder="Nombre del tema">
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
                text: "¿Está seguro que desea editar el tema?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {
    				var unidad               = $('#idDetalleUnidad').val();
                    var correlativo               = $('#correlativo').val();
                    var tema              =$('#tema').val();
                    
                    var data = {idDetalleUnidad: unidad, correlativo: correlativo, tema:tema};
                    $.post('<?php echo base_url()?>index.php/ContenidosControlador/editar/<?php echo $idContenido;?>/'+unidad,data,function(response){
                        if(response == 'ok'){
                            window.location = '<?php echo base_url()?>index.php/ContenidosControlador/index/'+unidad;
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