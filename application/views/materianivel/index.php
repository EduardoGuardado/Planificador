<br>
<div class="row">
    <div class="col-sm-12">
        <h3>Lista de Materias asignadas a grados</h3>
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
                    <?php foreach($materias as $res){ ?>
                    <option value="<?php echo $res->idMateria;?>"><?php echo $res->materia;?></option>
                    <?php }?>
                </select>
            </div>
            <span class="input-group-btn">
            <button id="btn_busqueda" class="btn btn-default btn-fill" type="button" >
                buscar
            </button>
            </span>
        </div>
    </div>
    <div class="col-sm-12 col-md-4 text-right">
        <a href="<?php echo base_url()?>index.php/InicioControlador/PerfilUsuario" class="btn btn-secondary">Volver</a>
        <a href="<?php echo base_url()?>index.php/MNControlador/insertar" class="btn btn-warning 41">Asignar Materias</a>
    </div>
</div>
<br>
<div class="row">
    <div class="col" id="divTabla">
        <?php $this->load->view('materianivel/tabla_mn'); ?>
    </div>
</div>

<script>
    $(function(){
        $(document).on("click", "button[data-eliminar]", function (evt) {
            var id = $(this).data("eliminar");
            
            swal({
                title: "Eliminar",
                text: "¿Está seguro que desea eliminar la materia?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {                    
                    var data = {id: id};
                    $.post('<?php echo base_url()?>index.php/MNControlador/eliminar',data,function(response){
                        if(response == 'ok'){
                            window.location = '<?php echo base_url()?>index.php/MNControlador';
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
            $.post('<?php echo base_url()?>index.php/MNControlador/buscar',{nivel:nivel,materia:materia}, function(response){
                $('#divTabla').html(response);
            });
        }
    });
</script>