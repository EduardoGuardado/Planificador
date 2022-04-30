<form class="form" method="post" id="frm">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3>Editar Materia</h3>
            <div id="errors" class="alert alert-danger" role="alert" style="display:none;"></div>
            <div class="form-group">
                <label for="codigo">ID</label>
                <input type="text" class="form-control" value="<?php echo $materia->idMateria; ?>" id="idMateria" name="idMateria" placeholder="ID" readonly>
            </div>
            <div class="form-group">
                <label for="materia">Materia</label>
                <select class="form-control" name="materia" id="materia">
                    <?php foreach($elegir as $e){ ?>
                    <option value="<?php echo $e->materia;?>" <?php if($e->materia == $materia->materia){echo " selected";}?>><?php echo $e->materia;?></option>
                    <?php }?>
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
                text: "¿Está seguro que desea editar la Materia?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {
                    var idMateria            = $('#idMateria').val();
                    var materia              = $('#materia').val();
                    
                    var data = {idMateria: idMateria, materia: materia};
                    $.post('<?php echo base_url()?>index.php/MateriasControlador/editar/<?php echo $idMateria;?>',data,function(response){
                        if(response == 'ok'){
                            window.location = '<?php echo base_url()?>index.php/MateriasControlador';
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