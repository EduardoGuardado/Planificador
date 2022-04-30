<form class="form" method="post" id="frm">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3>Editar Grado Académico</h3>
            <div id="errors" class="alert alert-danger" role="alert" style="display:none;"></div>
            <div class="form-group">
                <label for="idGrado">ID</label>
                <input type="text" class="form-control" value="<?php echo $grados->idGrado; ?>" id="idGrado" name="idGrado" placeholder="ID" readonly>
            </div>
            <div class="form-group">
                <label for="nivel">Nivel</label>
                <select class="form-control" id="nivel" name="nivel" aria-placeholder="Nivel">
                    <option value="1" <?php if($grados->nivel == 1){echo " selected";}?>>1</option>
                    <option value="2" <?php if($grados->nivel == 2){echo " selected";}?>>2</option>
                    <option value="3" <?php if($grados->nivel == 3){echo " selected";}?>>3</option>
                    <option value="4" <?php if($grados->nivel == 4){echo " selected";}?>>4</option>
                    <option value="5" <?php if($grados->nivel == 5){echo " selected";}?>>5</option>
                    <option value="6" <?php if($grados->nivel == 6){echo " selected";}?>>6</option>
                    <option value="7" <?php if($grados->nivel == 7){echo " selected";}?>>7</option>
                    <option value="8" <?php if($grados->nivel == 8){echo " selected";}?>>8</option>
                    <option value="9" <?php if($grados->nivel == 9){echo " selected";}?>>9</option>
                    <option value="10" <?php if($grados->nivel == 10){echo " selected";}?>>10</option>
                    <option value="11" <?php if($grados->nivel == 11){echo " selected";}?>>11</option>
                    <option value="12" <?php if($grados->nivel == 12){echo " selected";}?>>12</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tipo">Tipo</label>
                <select class="form-control" id="tipo" name="tipo" aria-placeholder="Tipo" value="<?php echo $grado->tipo; ?>">
                    <option value="B" <?php if($grados->tipo == "EB"){echo " selected";}?>>B -> "Educación Básica"</option>
                    <option value="M" <?php if($grados->tipo == "EM"){echo " selected";}?>>M -> "Educación Media"</option>
                </select>
            </div>
            <div class="form-group">
                <label for="seccion">Sección</label>
                <input type="text" class="form-control" value="<?php echo $grados->seccion; ?>" id="seccion" name="seccion" placeholder="A">
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
                text: "¿Está seguro que desea editar el grado académico?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {
                    var idGrado            = $('#idGrado').val();
                    var nivel              = $('#nivel').val();
                    var tipo               = $('#tipo').val();
                    var seccion            = $('#seccion').val();
                    
                    var data = {idGrado: idGrado, nivel: nivel, tipo: tipo, seccion: seccion};
                    $.post('<?php echo base_url()?>index.php/GradosControlador/editar/<?php echo $idGrado;?>',data,function(response){
                        if(response == 'ok'){
                            window.location = '<?php echo base_url()?>index.php/GradosControlador';
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