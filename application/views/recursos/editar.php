<form class="form" method="post" id="frm">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3>Editar Recurso</h3>
            <div id="errors" class="alert alert-danger" role="alert" style="display:none;"></div>
            <div class="form-group">
                <label for="idRecurso">ID</label>
                <input type="text" class="form-control" value="<?php echo $recursos->idRecurso; ?>" id="idRecurso" name="idRecurso" placeholder="ID" readonly>
            </div>
            <div class="form-group">
                <label for="idPlanDetalle">Planificación:</label>
                <select class="form-control" name="idPlanDetalle" id="idPlanDetalle">
                    <option>Seleccionar Planificación</option>
                    <?php foreach($especificar->result() as $res){ ?>
                    <option value="<?php echo $res->idPlanDetalle;?>" <?php if($res->idPlanDetalle == $recursos->idPlanDetalle){echo " selected";}?>><?php echo $res->nombre.": ".$res->materia." - Unidad ".$res->unidad.".".$res->nombreUnidad." [Tema: ".$res->tema."] - Fecha de ejecución: ".$res->Ejecutado;?></option>
                    <?php }?>
                </select>
            </div>
            <p class="fw-normal">Recurso a utilizar:</p>
			<div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="enlace" id="enlace" checked> Enlace
                </div>
                <input type="text" class="form-control" id="recurso" name="recurso" placeholder="Enlace del sitio web..." value="<?php echo $recursos->recurso;?>">
                <br>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="archivo" id="archivo"> Archivo
                </div>
                <input type="file" class="form-control" id="recursos" name="archivo" accept=".pdf,.jpg,.png" multiple disabled/>
            </div>
            <div class="form-group">
                <label for="tipo">Tipo:</label>
                <select class="form-control" name="tipo" id="tipo">
                    <option>Seleccionar tipo de recurso...</option>
                    <option value="1" <?php if($recursos->tipo == "enlace"){echo " selected";}?>>Enlace</option>
                    <option value="2" <?php if($recursos->tipo == "archivo"){echo " selected";}?>>Archivo</option>
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
                text: "¿Está seguro que desea editar el recurso?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {
                    var idRecurso         = $('#idRecurso').val();
                    var idPlanDetalle     = $('#idPlanDetalle').val();
					var recurso           = $('#recurso').val();
                    var tipo              = $('#tipo').val();

                    console.log("hola");
                    var data = {idRecurso: idRecurso, idPlanDetalle: idPlanDetalle, recurso: recurso, tipo: tipo};
                    $.post('<?php echo base_url()?>index.php/RecursosControlador/editar/<?php echo $idRecurso;?>',data,function(response){
                        if(response == 'ok'){
                            window.location = '<?php echo base_url()?>index.php/RecursosControlador';
                        }else{
                            $('#errors').html(response);
                            $('#errors').show();
                        }
                    });
                }
            });

            
		});
	});

    // Elección del tipo de recurso a utilizar
    const enlace = $('[name="enlace"]');
    const archivo = $('[name="archivo"]');

    // Evento para el Enlace
    $(function(){
        $('#enlace').click(function(){
            if($(this).is(':checked') == true){
                enlace.attr('disabled', false);
                enlace.focus();
            }else{
                enlace.attr('disabled', true);
                console.log("hola");
            }
        });
    });
</script>