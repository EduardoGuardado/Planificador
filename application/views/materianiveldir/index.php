<br>
<div class="row">
    <div class="col-sm-12">
        <h3>Lista de Asignaciones</h3>
    </div>
    <div class="col-xs-10 col-md-8">
        <div class="input-group">
        <label for="unidad">Nivel:</label>
            <div class="form-group">
                <select class="form-control" name="nivel" id="nivel">
                <option value="0">Seleccionar Nivel</option>
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
            <label for="materia">Materia:</label>
            <div class="form-group">
                <select class="form-control" name="idMateria" id="materia">
                    <option value="0">Seleccionar Materia</option>
                    <?php foreach($materias->result() as $res){ ?>
                    <option value="<?php echo $res->id;?>"><?php echo $res->nombre;?></option>
                    <?php }?>
                </select>
            </div>
            <span class="input-group-btn">
            <button id="btn_busqueda" class="btn btn-default btn-fill" type="button" >
                buscar
            </button>
            <a href="<?php echo base_url()?>index.php/MNDirControlador/insertar" class="btn btn-warning 41">Asignar Materias</a>
            </span>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col" id="divTabla">
        <?php $this->load->view('materianiveldir/tabla_mn'); ?>
    </div>
</div>

<script>
    $(function(){
        $(document).on("click", "button[data-eliminar]", function (evt) {
            var id = $(this).data("eliminar");
            
            swal({
                title: "Eliminar",
                text: "??Est?? seguro que desea eliminar la materia?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {                    
                    var data = {id: id};
                    $.post('<?php echo base_url()?>index.php/MNDirControlador/eliminar',data,function(response){
                        if(response == 'ok'){
                            window.location = '<?php echo base_url()?>index.php/MNDirControlador';
                        }
                    });
                }
            });
        });

        $('#btn_busqueda').click(function(){
            buscar();
        });

       /* $('#txt_busqueda').keyup(function(e){
            if(e.key == 'Enter'){
                buscar();
            }
        });*/

        function buscar(){
            //var criterio = $('#txt_busqueda').val() == "" ? 'all': $('#txt_busqueda').val();
            var nivel = $('#nivel').val();
            var materia = $('#materia').val();
            $.post('<?php echo base_url()?>index.php/MNDirControlador/buscar',{nivel:nivel,materia:materia}, function(response){
                $('#divTabla').html(response);
            });
        }
    });
</script>