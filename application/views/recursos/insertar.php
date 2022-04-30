<form class="form" method="post" id="frm" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3>Agregar Recurso</h3>
            <div id="errors" class="alert alert-danger" role="alert" style="display:none;"></div>
            <br>
            <div class="form-group">
                <label for="tipo">Tipo de recurso:</label>
                <select class="form-control" name="tipo" id="tipo">
                    <option>Seleccionar tipo de recurso...</option>
                    <option value="1">Enlace</option>
                    <option value="2">Archivo</option>
                </select>
            </div>

            <div class="form-group">
                <input class="form-control" type="hidden" name="idPlanDetalle" id="idPlanDetalle" value="<?php echo $idPlanDetalle;?>">
            </div>

            <br>
            <p class="h5">Recurso a utilizar:</p>
			<div class="form-group">
                <label id="titulo-enlace" for="enlace">Enlace:</label>
                <input type="text" class="form-control" id="recurso" name="enlace" placeholder="Enlace del sitio web...">
            </div>

            <div class="form-group">
                <label id="titulo-archivo" for="archivo">Archivo:</label>
                <input type="file" class="form-control-file" id="recurso" name="archivo">
            </div>
        </div>
        <div class="col-md-4 offset-md-6">
            <div class="row justify-content-end">
                <div class="col-md-auto text-right">
                    <a href="<?php echo base_url()?>index.php/PlanDetallesControlador/VerRecursos/<?php echo $idPlanDetalle;?>" class="btn btn-secondary">Volver</a>
                </div>
                <div class="col-sm-4 text-right">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function(){
        // Inician los dos deshabilitados
        $("[name = enlace]").prop('disabled', true);
        $("[name = archivo]").prop('disabled', true);

        // Ocultamos el input del archivo a insertar dependiendo de lo escogido
        $("#tipo").click(function(){
            if($("#tipo").val() == 1){
                // Mostramos título y elemento; lo habilitamos
                $("[name = enlace]").show();
                $("#titulo-enlace").show();
                $("[name = enlace]").prop('disabled', false);

                // Deshabilitamos el segundo elemento y lo ocultamos
                $("[name = archivo]").hide();
                $("#titulo-archivo").hide();
                $("[name = archivo]").prop('disabled', true);
            }else if($("#tipo").val() == 2){
                // Mostramos título y elemento; lo habilitamos
                $("[name = archivo]").show();
                $("#titulo-archivo").show();
                $("[name = archivo]").prop('disabled', false);

                // Deshabilitamos el primer elemento y lo ocultamos
                $("[name = enlace]").hide();
                $("#titulo-enlace").hide();
                $("[name = enlace]").prop('disabled', true);
            }
        });
    });

	$(function(){
		$('#frm').submit(function(e){
			e.preventDefault();
            $('#errors').hide();
            
            swal({
                title: "Guardar",
                text: "¿Está seguro que desea guardar el recurso?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {
                    var idPlanDetalle     = $('#idPlanDetalle').val();
					var recurso               = $('#recurso').val();
                    var tipo               = $('#tipo').val();
                    
                    if(tipo == 1){
                        var data = {idPlanDetalle: idPlanDetalle, recurso: recurso, tipo: tipo};
                        console.log(data);
                        $.post('<?php echo base_url()?>index.php/RecursosControlador/Insertar',data,function(response){
                            if(response == 'ok'){
                                window.location = '<?php echo base_url()?>index.php/PlanDetallesControlador/VerRecursos/<?php echo $idPlanDetalle;?>';
                            }else{
                                $('#errors').html(response);
                                $('#errors').show();
                            }
                        });
                    }else if(tipo == 2){
                        var formData = new FormData();

                        var archivo = $("[name=archivo]").change(function(event){
                            var files = event.target.files, file;
                            if(files && files.length > 0){
                                file = files[0];
                                if(file.size > 1024 * 1024 * 2){
                                    alert('El tamaño es muy grande');
                                    return false;
                                }
                                var URL = window.URL || window.webkitURL;
                            }
                        });

                        formData.append('file', archivo);

                        // datos a guardar en la base de datos
                        var data = {idPlanDetalle: idPlanDetalle, recurso: formData, tipo: tipo};
                        console.log(data);
                        $.ajax({
                            url: '<?php echo base_url()?>index.php/RecursosControlador/Insertar',
                            type: 'post',
                            data: data,
                            contentType: false,
                            processData: false,
                            success: function(response){
                                if(response != 0){
                                    alert("se envió");
                                    window.location = '<?php echo base_url()?>index.php/PlanDetallesControlador/VerRecursos/<?php echo $idPlanDetalle;?>';
                                }else{
                                    alert("No se envió");
                                }
                            }
                        });
                        

                        // enviar objeto a la base de datos
                        /*$.post('<?php //echo base_url()?>index.php/RecursosControlador/insertar',data,function(response){
                            if(response == 'ok'){
                                window.location = '<?php //echo base_url()?>index.php/PlanDetallesControlador/VerRecursos/<?php //echo $idPlanDetalle;?>';
                            }else{
                                $('#errors').html(response);
                                $('#errors').show();
                            }
                        });*/
                    }
                }
            });

            
		});
	});
</script>