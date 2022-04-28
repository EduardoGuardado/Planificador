<form class="form" method="post" id="frm">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3>Agregar Asignación</h3>
            <div id="errors" class="alert alert-danger" role="alert" style="display:none;"></div>
            <div class="form-group">
                <label for="materia">Materia a Asignar</label>
                <select class="form-control" name="idMateria" id="materia">
                    <option>Seleccionar Materia</option>
                    <?php foreach($materias->result() as $res){ ?>
                    <option value="<?php echo $res->id;?>"><?php echo $res->nombre;?></option>
                    <?php }?>
                </select>
            </div>
			<div class="form-group">
                <label for="grado">Grado</label>
                <select class="form-control" name="idGrado" id="grado">
                <option>Seleccionar Nivel</option>
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
                text: "¿Está seguro que desea guardar la Asignación?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {
    				var materia               = $('#materia').val();
                    var grado               = $('#grado').val();
                    
                    var data = {idMateria: materia, idGrado: grado};
                    console.log(data);
                    $.post('<?php echo base_url()?>index.php/MNDirControlador/insertar',data,function(response){
                        if(response == 'ok'){
                            window.location = '<?php echo base_url()?>index.php/MNDirControlador';
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