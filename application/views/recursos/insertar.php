<form class="form" action="<?php echo base_url()?>index.php/RecursosControlador/Insertar/<?php echo $idPlanDetalle;?>" method="post" id="frm" enctype="multipart/form-data">
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
                <input type="text" class="form-control" id="enlace" name="recurso" placeholder="Enlace del sitio web...">
            </div>

            <div class="form-group">
                <label id="titulo-archivo" for="archivo">Archivo:</label>
                <input type="file" class="form-control-file" id="archivo" name="recurso">
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
        $("#enlace").prop('disabled', true);
        $("#archivo").prop('disabled', true);

        // Ocultamos el input del archivo a insertar dependiendo de lo escogido
        $("#tipo").click(function(){
            if($("#tipo").val() == 1){
                // Mostramos título y elemento; lo habilitamos
                $("#enlace").show();
                $("#titulo-enlace").show();
                $("#enlace").prop('disabled', false);

                // Deshabilitamos el segundo elemento y lo ocultamos
                $("#archivo").hide();
                $("#titulo-archivo").hide();
                $("#archivo").prop('disabled', true);
            }else if($("#tipo").val() == 2){
                // Mostramos título y elemento; lo habilitamos
                $("#archivo").show();
                $("#titulo-archivo").show();
                $("#archivo").prop('disabled', false);

                // Deshabilitamos el primer elemento y lo ocultamos
                $("#enlace").hide();
                $("#titulo-enlace").hide();
                $("#enlace").prop('disabled', true);
            }
        });
    });
</script>
