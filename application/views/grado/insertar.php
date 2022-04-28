<form class="form" method="post" id="frm">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3>Agregar nuevo Grado</h3>
            <div id="errors" class="alert alert-danger" role="alert" style="display:none;"></div>
            <div class="form-group">
                <label for="nivel">Selección del Nivel</label>
                <select class="form-control" id="nivel" name="nombre" aria-placeholder="Nivel">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
                </select>
            </div>
            <div class="form-group">
                <label for="nivel">Selección del Tipo</label>
                <select class="form-control" id="tipo" name="nombre" aria-placeholder="Tipo">
                <option>EB</option>
                <option>EM</option>
                </select>
            </div>
            <!--
            <div class="form-group">
                <label for="nivel">Nivel</label>
                <input type="text" class="form-control" id="nivel" name="nombre" placeholder="Nivel">
            </div>
            <div class="form-group">
                <label for="tipo">Tipo</label>
                <input type="text" class="form-control" id="tipo" name="nombre" placeholder="Tipo">
            </div>
            -->
            <div class="form-group">
                <label for="seccion">Sección del Nivel</label>
                <input type="text" class="form-control" id="seccion" name="nombre" placeholder="Sección del Nivel">
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
                text: "¿Está seguro que desea guardar el Grado?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {
                    var nivel               = $('#nivel').val();
                    var tipo               = $('#tipo').val();
                    var seccion               = $('#seccion').val();
                    
                    var data = {nivel: nivel, tipo: tipo, seccion: seccion};
                    $.post('<?php echo base_url()?>index.php/GradoControlador/insertar',data,function(response){
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