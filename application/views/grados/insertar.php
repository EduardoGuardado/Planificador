<form class="form" method="post" id="frm">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3>Agregar Grado Académico</h3>
            <div id="errors" class="alert alert-danger" role="alert" style="display:none;"></div>
            <div class="form-group">
                <label for="idGrado">ID</label>
                <input type="text" class="form-control" id="idGrado" name="idGrado" placeholder="ID" readonly>
            </div>
            <div class="form-group">
                <label for="nivel">Nivel</label>
                <select class="form-control" id="nivel" name="nivel" aria-placeholder="Nivel">
                    <option value="1">1°</option>
                    <option value="2">2°</option>
                    <option value="3">3°</option>
                    <option value="4">4°</option>
                    <option value="5">5°</option>
                    <option value="6">6°</option>
                    <option value="7">7°</option>
                    <option value="8">8°</option>
                    <option value="9">9°</option>
                    <option value="10">10°</option>
                    <option value="11">11°</option>
                    <option value="12">12°</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tipo">Tipo</label>
                <select class="form-control" id="tipo" name="tipo" aria-placeholder="Tipo">
                    <option value="B">B -> "Educación Básica"</option>
                    <option value="M">M -> "Educación Media"</option>
                </select>
            </div>
            <div class="form-group">
                <label for="seccion">Sección</label>
                <input type="text" class="form-control" id="seccion" name="seccion" placeholder="Primer Grado A -o- Primero General B">
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
                    $.post('<?php echo base_url()?>index.php/GradosControlador/insertar',data,function(response){
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