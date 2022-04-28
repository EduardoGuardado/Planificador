<form class="form" method="post" id="frm">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3>Modificación de datos de la sección</h3>
            <div id="errors" class="alert alert-danger" role="alert" style="display:none;"></div>
            <div class="form-group">
                <label for="nivel">Selección del Nivel</label>
                <select class="form-control" id="nivel" name="nivel" aria-placeholder="Nivel">
                <option value="1" <?php if($grado->nivel == 1){echo " selected";}?>>1</option>
                <option value="2" <?php if($grado->nivel == 2){echo " selected";}?>>2</option>
                <option value="3" <?php if($grado->nivel == 3){echo " selected";}?>>3</option>
                <option value="4" <?php if($grado->nivel == 4){echo " selected";}?>>4</option>
                <option value="5" <?php if($grado->nivel == 5){echo " selected";}?>>5</option>
                <option value="6" <?php if($grado->nivel == 6){echo " selected";}?>>6</option>
                <option value="7" <?php if($grado->nivel == 7){echo " selected";}?>>7</option>
                <option value="8" <?php if($grado->nivel == 8){echo " selected";}?>>8</option>
                <option value="9" <?php if($grado->nivel == 9){echo " selected";}?>>9</option>
                <option value="10" <?php if($grado->nivel == 10){echo " selected";}?>>10</option>
                <option value="11" <?php if($grado->nivel == 11){echo " selected";}?>>11</option>
                <option value="12" <?php if($grado->nivel == 12){echo " selected";}?>>12</option>
                </select>
            </div>
            <div class="form-group">
                <label for="nivel">Selección del Tipo</label>
                <select class="form-control" id="tipo" name="tipo" aria-placeholder="Tipo" value="<?php echo $grado->tipo; ?>">
                <option value="EB" <?php if($grado->tipo == "EB"){echo " selected";}?>>EB</option>
                <option value="EM" <?php if($grado->tipo == "EM"){echo " selected";}?>>EM</option>
                </select>
            </div>
            <div class="form-group">
                <label for="seccion">Sección</label>
                <input type="text" class="form-control" id="seccion" name="seccion" placeholder="seccion" value="<?php echo $grado->seccion; ?>">
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
                text: "¿Está seguro que desea editar el profesional?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {
                    var nivel               = $('#nivel').val();
                    var tipo               = $('#tipo').val();
                    var seccion               = $('#seccion').val();
                    
                    var data = {nivel: nivel, tipo: tipo, seccion: seccion};
                    $.post('<?php echo base_url()?>index.php/GradoControlador/editar/<?php echo $id;?>',data,function(response){
                        if(response == 'ok'){
                            window.location = '<?php echo base_url()?>index.php/GradoControlador';
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