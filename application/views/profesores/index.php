<br>
<div class="row">
    <div class="col-sm-12">
        <h3>Profesores</h3>
    </div>

    <div class="col-xs-10 col-md-8">
        <div class="input-group">
            <select class="form-control" id="profesor">
                <option value="0">Seleccionar el Profesor...</option>
                <?php foreach($ListaProfesores as $profesores){?>
                    <?php if ($profesores->rol != $rol) {?>
                        <option value="<?php echo $profesores->idUsuario;?>"><?php echo $profesores->nombre." ".$profesores->apellido;?></option>
                    <?php }?>
                <?php }?>
            </select>
            <span class="input-group-btn">
            <button id="btn_busqueda" class="btn btn-default btn-fill" type="button" >
                buscar
            </button>
            </span>
        </div>
    </div>

    <div class="col-sm-12 col-md-4 text-right">
        <a href="<?php echo base_url()?>index.php/ProfesoresControlador/Insertar" class="btn btn-primary">Agregar</a>
    </div>
</div>

<br>

<div class="row">
    <div class="container-fluid" id="divTabla">
        <?php $this->load->view('profesores/profesoresListado'); ?>
    </div>
</div>

<script>
    $(function(){
        $(document).on("click", "button[data-eliminar]", function (evt) {
            var id = $(this).data("eliminar");
            
            swal({
                title: "Eliminar",
                text: "¿Está seguro que desea eliminar el Profesor?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {      

                    var data = {id: id};

                    $.post('<?php echo base_url()?>index.php/ProfesoresControlador/Eliminar',data,function(response){
                        if(response == 'ok'){
                            window.location = '<?php echo base_url()?>index.php/PerfilesControlador/VerProfesores';
                        }
                    });
                }
            });
        });

        $('#btn_busqueda').click(function(){
            buscar();
        });

        function buscar(){
            var profesor = $('#profesor').val();

            $.post('<?php echo base_url()?>index.php/ProfesoresControlador/Buscar',{profesor:profesor}, function(response){
                $('#divTabla').html(response);
            });
        }
    });
</script>