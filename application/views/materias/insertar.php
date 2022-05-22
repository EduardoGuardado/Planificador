<form class="form" method="post" id="frm">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3>Agregar Usuario</h3>
            <div id="errors" class="alert alert-danger" role="alert" style="display:none;"></div>
            <div class="form-group">
                <label for="idMateria">ID</label>
                <input type="text" class="form-control" id="idMateria" name="idMateria" placeholder="ID" readonly>
            </div>
            <div class="form-group">
                <label for="materia">Materia</label>
                <input type="text" class="form-control" id="materia" name="materia" placeholder="Matemática...">
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
                text: "¿Está seguro que desea guardar la Materia?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {
                    var materia               = $('#materia').val();
                    
                    var data = {materia: materia};
                    $.post('<?php echo base_url()?>index.php/MateriasControlador/insertar',data,function(response){
                        if(response == 'ok'){
                            window.location = '<?php echo base_url()?>index.php/PerfilesControlador/VerMaterias';
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